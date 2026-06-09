<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private function admin(array $overrides = []): User
    {
        return User::query()->create(array_merge([
            'name' => 'Admin User',
            'username' => 'admin_user',
            'email' => 'admin@example.com',
            'password' => 'Admin123!',
            'role' => 'admin',
            'is_active' => true,
        ], $overrides));
    }

    private function employee(array $overrides = []): User
    {
        return User::query()->create(array_merge([
            'name' => 'Employee User',
            'username' => 'employee_user',
            'email' => 'employee@example.com',
            'password' => 'Password1!',
            'role' => 'user',
            'is_active' => true,
        ], $overrides));
    }

    public function test_everyone_can_see_all_tasks_but_only_creator_assignees_can_modify_them(): void
    {
        $admin = $this->admin();

        $workspace = Workspace::query()->create([
            'name' => 'Task Workspace',
            'status' => 'active',
            'created_by_user_id' => $admin->id,
        ]);

        $admin->update(['workspace_id' => $workspace->id]);

        $employeeOne = $this->employee([
            'username' => 'employee_one',
            'email' => 'employee1@example.com',
            'workspace_id' => $workspace->id,
        ]);
        $employeeTwo = $this->employee([
            'username' => 'employee_two',
            'email' => 'employee2@example.com',
            'workspace_id' => $workspace->id,
        ]);

        // ── Employee One creates a task assigned to themselves ──
        Sanctum::actingAs($employeeOne);

        $ownTask = $this->postJson('/api/tasks', [
            'workspace_id' => $workspace->id,
            'title' => 'Employee owned task',
            'description' => 'Created by the employee.',
            'status' => 'todo',
            'priority' => 'medium',
            'assignee_ids' => [$employeeOne->id],
        ])
            ->assertCreated()
            ->json('data');

        $this->assertDatabaseHas('tasks', [
            'id' => $ownTask['id'],
            'created_by_user_id' => $employeeOne->id,
        ]);
        $this->assertDatabaseHas('task_assignees', [
            'task_id' => $ownTask['id'],
            'user_id' => $employeeOne->id,
        ]);

        // ── Admin creates a task assigned to admin ──
        Sanctum::actingAs($admin);

        $adminOwnedTask = $this->postJson('/api/tasks', [
            'workspace_id' => $workspace->id,
            'title' => 'Admin owned task',
            'description' => 'Assigned to admin and visible to everyone.',
            'status' => 'todo',
            'priority' => 'high',
            'assignee_ids' => [$admin->id],
        ])
            ->assertCreated()
            ->json('data');

        // ── Employee Two can SEE all tasks (same workspace) ──
        Sanctum::actingAs($employeeTwo);

        $this->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonFragment(['id' => $ownTask['id']])
            ->assertJsonFragment(['id' => $adminOwnedTask['id']]);

        // ── Employee Two CANNOT modify Employee One's task ──
        $this->putJson('/api/tasks/' . $ownTask['id'], [
            'status' => 'in-progress',
        ])
            ->assertStatus(403);

        // ── Employee One CAN modify their own task ──
        Sanctum::actingAs($employeeOne);

        $this->putJson('/api/tasks/' . $ownTask['id'], [
            'status' => 'in-progress',
        ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $ownTask['id'],
            'status' => 'in-progress',
            'completed' => false,
        ]);

        // ── Employee Two CANNOT delete Employee One's task ──
        Sanctum::actingAs($employeeTwo);

        $this->deleteJson('/api/tasks/' . $ownTask['id'])
            ->assertStatus(403);

        // ── Admin CAN modify admin-owned task ──
        Sanctum::actingAs($admin);

        $this->putJson('/api/tasks/' . $adminOwnedTask['id'], [
            'status' => 'in-progress',
        ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $adminOwnedTask['id'],
            'status' => 'in-progress',
        ]);

        // ── Employee One CANNOT modify admin-owned task ──
        Sanctum::actingAs($employeeOne);

        $this->putJson('/api/tasks/' . $adminOwnedTask['id'], [
            'status' => 'done',
        ])
            ->assertStatus(403);

        // ── Employee One CAN mark their own task done ──
        $this->putJson('/api/tasks/' . $ownTask['id'], [
            'status' => 'done',
        ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $ownTask['id'],
            'status' => 'done',
            'completed' => true,
        ]);

        // ── Employee One CAN delete their own task ──
        $this->deleteJson('/api/tasks/' . $ownTask['id'])
            ->assertOk();

        $this->assertDatabaseMissing('tasks', [
            'id' => $ownTask['id'],
        ]);
    }

    public function test_admins_can_manage_any_task_regardless_of_assignment(): void
    {
        $adminOne = $this->admin([
            'username' => 'admin_one',
            'email' => 'admin1@example.com',
        ]);
        $adminTwo = $this->admin([
            'username' => 'admin_two',
            'email' => 'admin2@example.com',
        ]);

        $workspaceOne = Workspace::query()->create([
            'name' => 'Workspace One',
            'status' => 'active',
            'created_by_user_id' => $adminOne->id,
        ]);
        $workspaceTwo = Workspace::query()->create([
            'name' => 'Workspace Two',
            'status' => 'active',
            'created_by_user_id' => $adminTwo->id,
        ]);

        $adminOne->update(['workspace_id' => $workspaceOne->id]);
        $adminTwo->update(['workspace_id' => $workspaceTwo->id]);

        // ── Admin One creates a task ──
        Sanctum::actingAs($adminOne);

        $task = $this->postJson('/api/tasks', [
            'workspace_id' => $workspaceOne->id,
            'title' => 'Admin One task',
            'description' => 'Only assigned to Admin One.',
            'status' => 'todo',
            'priority' => 'medium',
            'assignee_ids' => [$adminOne->id],
        ])
            ->assertCreated()
            ->json('data');

        // ── Admin Two (god-mode) can modify Admin One's task ──
        Sanctum::actingAs($adminTwo);

        $this->putJson('/api/tasks/' . $task['id'], [
            'status' => 'in-progress',
        ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $task['id'],
            'status' => 'in-progress',
        ]);

        // ── Admin One can mark it done ──
        Sanctum::actingAs($adminOne);

        $this->putJson('/api/tasks/' . $task['id'], [
            'status' => 'done',
        ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $task['id'],
            'status' => 'done',
            'completed' => true,
        ]);

        // ── Admin Two (god-mode) can delete Admin One's task ──
        Sanctum::actingAs($adminTwo);

        $this->deleteJson('/api/tasks/' . $task['id'])
            ->assertOk();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task['id'],
        ]);
    }
}
