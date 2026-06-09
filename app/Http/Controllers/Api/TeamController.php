<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $teams = Team::query()
            ->with(['workspace'])
            ->when($request->filled('workspace_id'), fn ($query) => $query->where('workspace_id', $request->integer('workspace_id')))
            ->latest()
            ->get();

        return response()->json(['data' => $teams]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'workspace_id' => ['required', 'exists:workspaces,id'],
            'name' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,archived'],
        ]);

        $workspaceId = $validated['workspace_id'];
        $validated['name'] = trim($validated['name']);

        if (Team::query()->where('workspace_id', $workspaceId)->where('name', $validated['name'])->exists()) {
            return response()->json([
                'message' => 'That department already exists in this workspace.',
            ], 422);
        }

        $team = Team::query()->create([
            ...$validated,
            'status' => $validated['status'] ?? 'active',
        ]);

        return response()->json([
            'message' => 'Team created.',
            'data' => $team->load('workspace'),
        ], 201);
    }

    public function show(Team $team)
    {
        return response()->json([
            'data' => $team->load(['workspace', 'users', 'tasks']),
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'workspace_id' => ['sometimes', 'required', 'exists:workspaces,id'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => ['nullable', 'in:active,archived'],
        ]);

        $workspaceId = $validated['workspace_id'] ?? $team->workspace_id;
        $name = isset($validated['name']) ? trim($validated['name']) : $team->name;

        if (Team::query()
            ->where('workspace_id', $workspaceId)
            ->where('name', $name)
            ->whereKeyNot($team->id)
            ->exists()) {
            return response()->json([
                'message' => 'That department already exists in this workspace.',
            ], 422);
        }

        $validated['name'] = $name;

        $team->update($validated);

        return response()->json([
            'message' => 'Team updated.',
            'data' => $team->fresh()->load('workspace'),
        ]);
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json(['message' => 'Team deleted.']);
    }
}
