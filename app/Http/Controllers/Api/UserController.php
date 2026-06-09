<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->with(['workspace', 'team'])
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->string('role')))
            ->when($request->filled('status'), fn ($query) => $query->where('is_active', $request->boolean('status')))
            ->when($request->filled('workspace_id'), fn ($query) => $query->where('workspace_id', $request->integer('workspace_id')))
            ->when($request->filled('team_id'), fn ($query) => $query->where('team_id', $request->integer('team_id')))
            ->latest()
            ->get();

        return response()->json(['data' => $users]);
    }

    public function store(StoreUserRequest $request, NotificationService $notifications)
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'phone' => $validated['phone'] ?? null,
            'department' => $this->resolveDepartmentName($validated['team_id'] ?? null),
            'role' => $validated['role'],
            'workspace_id' => $validated['workspace_id'] ?? null,
            'team_id' => $validated['team_id'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        $actor = $request->user();
        $notifications->sendToUser(
            $user,
            'Account created',
            sprintf('Your Workforce Hub account is ready for %s.', $user->workspace?->name ?? 'your workspace'),
            'success',
            ['user_id' => $user->id, 'workspace_id' => $user->workspace_id]
        );

        if ($actor) {
            $notifications->sendToUser(
                $actor,
                'User account created',
                sprintf('You created %s.', $user->name),
                'success',
                ['user_id' => $user->id]
            );
        }

        return response()->json([
            'message' => 'User created.',
            'data' => $user->load(['workspace', 'team']),
        ], 201);
    }

    public function show(User $user)
    {
        return response()->json(['data' => $user->load(['workspace', 'team'])]);
    }

    public function update(UpdateUserRequest $request, User $user, NotificationService $notifications)
    {
        $validated = $request->validated();
        $actor = $request->user();
        $notifyChanges = false;

        if (array_key_exists('password', $validated) && $validated['password']) {
            // Laravel's hashed cast will hash the incoming plain-text password.
        } else {
            unset($validated['password']);
        }

        if (array_key_exists('team_id', $validated)) {
            $validated['department'] = $this->resolveDepartmentName($validated['team_id']);
        }

        $user->update($validated);

        if (! empty($validated)) {
            $notifyChanges = true;
        }

        if ($notifyChanges) {
            $notifications->sendToUser(
                $user,
                'Account updated',
                'Your account details were updated.',
                'info',
                ['user_id' => $user->id, 'changes' => array_keys($validated)]
            );

            if ($actor) {
                $notifications->sendToUser(
                    $actor,
                    'User account updated',
                    sprintf('You updated %s.', $user->name),
                    'success',
                    ['user_id' => $user->id, 'changes' => array_keys($validated)]
                );
            }
        }

        return response()->json([
            'message' => 'User updated.',
            'data' => $user->fresh()->load(['workspace', 'team']),
        ]);
    }

    private function resolveDepartmentName(?int $teamId): ?string
    {
        if (! $teamId) {
            return null;
        }

        return Team::query()->find($teamId)?->name;
    }

    public function destroy(Request $request, User $user, NotificationService $notifications)
    {
        $actor = $request->user();
        if ($actor) {
            $notifications->sendToUser(
                $actor,
                'User account deleted',
                sprintf('You deleted %s.', $user->name),
                'warning',
                ['user_id' => $user->id]
            );
        }

        $user->delete();

        return response()->json(['message' => 'User deleted.']);
    }
}
