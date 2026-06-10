<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AdminWorkspaceSwitchTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_switch_their_workspace_context(): void
    {
        $admin = User::query()->create([
            'name' => 'Admin User',
            'username' => 'admin_user',
            'email' => 'admin@example.com',
            'password' => 'Admin123!',
            'role' => 'admin',
            'is_active' => true,
        ]);

        $workspaceOne = Workspace::query()->create([
            'name' => 'Workspace One',
            'status' => 'active',
            'created_by_user_id' => $admin->id,
        ]);

        $workspaceTwo = Workspace::query()->create([
            'name' => 'Workspace Two',
            'status' => 'active',
            'created_by_user_id' => $admin->id,
        ]);

        $admin->update(['workspace_id' => $workspaceOne->id]);

        Sanctum::actingAs($admin);

        $this->putJson('/api/me/workspace', [
            'workspace_id' => $workspaceTwo->id,
        ])
            ->assertOk()
            ->assertJsonPath('user.workspace.id', $workspaceTwo->id);

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'workspace_id' => $workspaceTwo->id,
        ]);
    }

    public function test_non_admins_cannot_switch_workspace_context(): void
    {
        $user = User::query()->create([
            'name' => 'Regular User',
            'username' => 'regular_user',
            'email' => 'user@example.com',
            'password' => 'Password1!',
            'role' => 'user',
            'is_active' => true,
        ]);

        $workspace = Workspace::query()->create([
            'name' => 'Workspace',
            'status' => 'active',
            'created_by_user_id' => $user->id,
        ]);

        $user->update(['workspace_id' => $workspace->id]);

        Sanctum::actingAs($user);

        $this->putJson('/api/me/workspace', [
            'workspace_id' => $workspace->id,
        ])
            ->assertForbidden();
    }
}
