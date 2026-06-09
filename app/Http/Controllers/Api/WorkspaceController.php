<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WorkspaceController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureAdmin($request);

        $workspaces = Workspace::query()
            ->with(['creator'])
            ->withCount(['teams', 'tasks', 'users'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->latest()
            ->get();

        return response()->json(['data' => $workspaces]);
    }

    public function store(Request $request, NotificationService $notifications)
    {
        $this->ensureAdmin($request);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:workspaces,name'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(['active', 'archived'])],
            'color' => ['nullable', 'string', 'max:255'],
        ]);

        $workspace = DB::transaction(function () use ($request, $validated) {
            $workspace = Workspace::query()->create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'status' => $validated['status'] ?? 'active',
                'color' => $validated['color'] ?? null,
                'created_by_user_id' => $request->user()->id,
            ]);

            $request->user()->forceFill([
                'workspace_id' => $workspace->id,
            ])->save();

            return $workspace;
        });

        $notifications->sendToUser(
            $request->user(),
            'Workspace created',
            sprintf('You created workspace "%s".', $workspace->name),
            'success',
            ['workspace_id' => $workspace->id]
        );

        return response()->json([
            'message' => 'Workspace created.',
            'data' => $workspace->load(['creator'])->loadCount(['teams', 'tasks', 'users']),
        ], 201);
    }

    public function show(Request $request, Workspace $workspace)
    {
        $this->ensureAdmin($request);

        return response()->json([
            'data' => $workspace->load(['teams', 'tasks', 'users', 'creator']),
        ]);
    }

    public function update(Request $request, Workspace $workspace, NotificationService $notifications)
    {
        $this->ensureAdmin($request);

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('workspaces', 'name')->ignore($workspace->id)],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(['active', 'archived'])],
            'color' => ['nullable', 'string', 'max:255'],
        ]);

        $workspace->update($validated);

        $notifications->sendToUser(
            $request->user(),
            'Workspace updated',
            sprintf('You updated workspace "%s".', $workspace->name),
            'info',
            ['workspace_id' => $workspace->id, 'changes' => array_keys($validated)]
        );

        return response()->json([
            'message' => 'Workspace updated.',
            'data' => $workspace->fresh()->load(['creator'])->loadCount(['teams', 'tasks', 'users']),
        ]);
    }

    public function destroy(Request $request, Workspace $workspace, NotificationService $notifications)
    {
        $this->ensureAdmin($request);

        if ((int) $workspace->created_by_user_id !== (int) $request->user()->id) {
            throw new HttpResponseException(response()->json([
                'message' => 'You can only delete workspaces you created.',
            ], 403));
        }

        $notifications->sendToUser(
            $request->user(),
            'Workspace deleted',
            sprintf('You deleted workspace "%s".', $workspace->name),
            'warning',
            ['workspace_id' => $workspace->id]
        );

        $workspace->delete();

        return response()->json(['message' => 'Workspace deleted.']);
    }

    private function ensureAdmin(Request $request): void
    {
        if ($request->user()->role !== 'admin') {
            throw new HttpResponseException(response()->json(['message' => 'Forbidden.'], 403));
        }
    }
}
