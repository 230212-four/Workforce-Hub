<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Services\NotificationService;

class TaskController extends Controller
{
    private const ALLOWED_STATUSES = ['todo', 'in-progress', 'review', 'done'];
    private const MAX_ASSIGNEES = 5;

    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = Task::query()
            ->with(['workspace', 'team', 'creator', 'assignee', 'assignedUsers'])
            ->when($user->role !== 'admin', fn ($query) => $query->where('workspace_id', $user->workspace_id))
            ->when($request->filled('workspace_id'), fn ($query) => $query->where('workspace_id', $request->integer('workspace_id')))
            ->when($request->filled('team_id'), fn ($query) => $query->where('team_id', $request->integer('team_id')))
            ->when($request->filled('assigned_to_user_id'), fn ($query) => $query->whereHas('assignedUsers', fn ($assignedQuery) => $assignedQuery->where('users.id', $request->integer('assigned_to_user_id'))))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()
            ->get();

        return response()->json([
            'data' => $tasks->map(fn (Task $task) => $this->transformTask($task)),
        ]);
    }

    public function store(Request $request, NotificationService $notifications)
    {
        $user = $request->user();
        $isAdmin = $user->role === 'admin';

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(self::ALLOWED_STATUSES)],
            'priority' => ['nullable', Rule::in(['low', 'medium', 'high'])],
            'due_date' => ['nullable', 'date'],
            'completed' => ['nullable', 'boolean'],
        ];

        if ($isAdmin) {
            $rules['workspace_id'] = ['nullable', 'exists:workspaces,id'];
            $rules['team_id'] = ['nullable', 'exists:teams,id'];
        }

        $validated = $request->validate($rules);

        $workspaceId = $this->resolveTaskWorkspaceId($request, $validated);

        $assigneeIds = [$user->id];

        if ($isAdmin) {
            $assigneeValidated = $request->validate([
                'assignee_ids' => ['required', 'array', 'min:1', 'max:' . self::MAX_ASSIGNEES],
                'assignee_ids.*' => [
                    'distinct',
                    Rule::exists('users', 'id')->where(fn ($query) => $query->where('workspace_id', $workspaceId)),
                ],
            ]);

            $assigneeIds = $this->finalizeAssigneeIds($assigneeValidated['assignee_ids'], $user->id, $workspaceId);
        }

        $status = $validated['status'] ?? 'todo';
        $isCompleted = ($validated['completed'] ?? false) || $status === 'done';

        $task = DB::transaction(function () use ($request, $validated, $workspaceId, $assigneeIds, $status, $isCompleted) {
            $isAdmin = $request->user()->role === 'admin';

            $task = Task::query()->create([
                'workspace_id' => $workspaceId,
                'team_id' => $isAdmin ? ($validated['team_id'] ?? null) : null,
                'assigned_to_user_id' => $assigneeIds[0] ?? $request->user()->id,
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'status' => $status === 'done' ? 'done' : $status,
                'priority' => $validated['priority'] ?? 'medium',
                'due_date' => $validated['due_date'] ?? null,
                'completed' => $isCompleted,
                'completed_at' => $isCompleted ? now() : null,
                'created_by_user_id' => $request->user()->id,
            ]);

            $task->assignedUsers()->sync($assigneeIds);

            return $task;
        });

        $task = $task->fresh()->load(['workspace', 'team', 'creator', 'assignee', 'assignedUsers']);

        $assignees = $task->assignedUsers;
        $notifications->sendToUsers(
            $assignees,
            'New task assigned',
            sprintf('You have been assigned to "%s".', $task->title),
            'info',
            ['task_id' => $task->id, 'workspace_id' => $task->workspace_id]
        );

        $notifications->sendToUser(
            $request->user(),
            'Task created',
            sprintf('You created "%s".', $task->title),
            'success',
            ['task_id' => $task->id]
        );

        return response()->json([
            'message' => 'Task created.',
            'data' => $task,
        ], 201);
    }

    public function show(Request $request, Task $task)
    {
        return response()->json([
            'data' => $this->transformTask($task->load(['workspace', 'team', 'creator', 'assignee', 'assignedUsers'])),
        ]);
    }

    public function update(Request $request, Task $task, NotificationService $notifications)
    {
        $user = $request->user();

        $this->authorizeTaskUpdate($user, $task);

        $rules = [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['sometimes', Rule::in(self::ALLOWED_STATUSES)],
            'priority' => ['nullable', Rule::in(['low', 'medium', 'high'])],
            'due_date' => ['nullable', 'date'],
            'completed' => ['nullable', 'boolean'],
        ];

        if ($user->role === 'admin') {
            $rules['workspace_id'] = ['sometimes', 'nullable', 'exists:workspaces,id'];
            $rules['team_id'] = ['sometimes', 'nullable', 'exists:teams,id'];
        }

        $validated = $request->validate($rules);
        $workspaceId = $this->resolveTaskWorkspaceId($request, $validated, $task);
        $updates = $user->role === 'admin'
            ? array_intersect_key($validated, array_flip([
                'workspace_id',
                'team_id',
                'title',
                'description',
                'status',
                'priority',
                'due_date',
                'completed',
            ]))
            : array_intersect_key($validated, array_flip([
                'title',
                'description',
                'status',
                'priority',
                'due_date',
                'completed',
            ]));
        $changeKeys = array_keys($updates);

        if ($user->role === 'admin' && array_key_exists('assignee_ids', $validated)) {
            $request->validate([
                'assignee_ids' => ['required', 'array', 'min:1', 'max:' . self::MAX_ASSIGNEES],
                'assignee_ids.*' => [
                    'distinct',
                    Rule::exists('users', 'id')->where(fn ($query) => $query->where('workspace_id', $workspaceId)),
                ],
            ]);

            $changeKeys[] = 'assignee_ids';
        }

        $this->syncCompletionFields($updates);

        DB::transaction(function () use ($task, $updates, $validated, $user) {
            if ($user->role === 'admin' && array_key_exists('assignee_ids', $validated)) {
                $assigneeIds = $this->finalizeAssigneeIds($validated['assignee_ids'], $task->created_by_user_id, $task->workspace_id);
                $task->assignedUsers()->sync($assigneeIds);
                $updates['assigned_to_user_id'] = $assigneeIds[0] ?? null;
            }

            $task->update($updates);
        });

        $task = $task->fresh()->load(['workspace', 'team', 'creator', 'assignee', 'assignedUsers']);

        if (! empty($changeKeys)) {
            $notifications->sendToUsers(
                $task->assignedUsers,
                'Task updated',
                sprintf('"%s" was updated.', $task->title),
                'info',
                ['task_id' => $task->id, 'status' => $task->status]
            );

            $notifications->sendToUser(
                $user,
                'Task updated',
                sprintf('You updated "%s".', $task->title),
                'success',
                ['task_id' => $task->id, 'changes' => $changeKeys]
            );
        }

        return response()->json([
            'message' => 'Task updated.',
            'data' => $task,
        ]);
    }

    public function destroy(Request $request, Task $task, NotificationService $notifications)
    {
        $this->authorizeTaskUpdate($request->user(), $task);

        $notifications->sendToUser(
            $request->user(),
            'Task deleted',
            sprintf('You deleted "%s".', $task->title),
            'warning',
            ['task_id' => $task->id]
        );
        $task->delete();

        return response()->json(['message' => 'Task deleted.']);
    }

    private function ensureAdmin(Request $request): void
    {
        if ($request->user()->role !== 'admin') {
            throw new HttpResponseException(response()->json(['message' => 'Forbidden.'], 403));
        }
    }

    private function authorizeTaskUpdate(User $user, Task $task): void
    {
        if ($user->role === 'admin') {
            return;
        }

        $isAssigned = $task->assignedUsers()->where('users.id', $user->id)->exists();

        if (! $isAssigned) {
            throw new HttpResponseException(response()->json(['message' => 'You can only update tasks you are assigned to.'], 403));
        }
    }

    private function syncCompletionFields(array &$updates): void
    {
        if (array_key_exists('status', $updates)) {
            $updates['completed'] = $updates['status'] === 'done';
            $updates['completed_at'] = $updates['completed'] ? Carbon::now() : null;

            return;
        }

        if (array_key_exists('completed', $updates)) {
            $updates['status'] = $updates['completed'] ? 'done' : 'todo';
            $updates['completed_at'] = $updates['completed'] ? Carbon::now() : null;
        }
    }

    private function resolveTaskWorkspaceId(Request $request, array $validated, ?Task $task = null): int
    {
        $workspaceId = $validated['workspace_id'] ?? $task?->workspace_id ?? $request->user()->workspace_id;

        if (! $workspaceId) {
            throw ValidationException::withMessages([
                'workspace_id' => 'Workspace is required to assign tasks.',
            ]);
        }

        return (int) $workspaceId;
    }

    /**
     * @param  array<int, int|string>  $assigneeIds
     * @return array<int, int>
     */
    private function finalizeAssigneeIds(array $assigneeIds, int $creatorId, int $workspaceId): array
    {
        $finalAssigneeIds = collect($assigneeIds)
            ->map(fn ($id) => (int) $id)
            ->push($creatorId)
            ->unique()
            ->values()
            ->all();

        if (count($finalAssigneeIds) > self::MAX_ASSIGNEES) {
            throw ValidationException::withMessages([
                'assignee_ids' => sprintf('A task can have at most %d assignees.', self::MAX_ASSIGNEES),
            ]);
        }

        return $finalAssigneeIds;
    }

    private function transformTask(Task $task): array
    {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'priority' => $task->priority,
            'due_date' => optional($task->due_date)->toDateString(),
            'completed' => (bool) $task->completed,
            'completed_at' => optional($task->completed_at)->toDateTimeString(),
            'workspace_id' => $task->workspace_id,
            'team_id' => $task->team_id,
            'created_by_user_id' => $task->created_by_user_id,
            'assigned_to_user_id' => $task->assigned_to_user_id,
            'workspace' => $task->workspace,
            'team' => $task->team,
            'creator' => $task->creator,
            'assignee' => $task->assignee,
            'assigned_users' => $task->assignedUsers,
            'assignee_names' => $task->assignee_names,
        ];
    }
}
