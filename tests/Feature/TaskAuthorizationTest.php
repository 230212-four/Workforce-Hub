<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    private function tokenFor(User $user, string $password): string
    {
        return $this->postJson('/api/login', [
            'identifier' => $user->email,
            'password' => $password,
        ])->assertOk()->json('token');
    }

    public function test_everyone_can_see_all_tasks_but_only_creator_assignees_can_modify_them(): void
    {
        $admin = $this->admin();

        $adminToken = $this->tokenFor($admin, 'Admin123!');

        $workspace = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->postJson('/api/workspaces', [
                'name' => 'Task Workspace',
                'status' => 'active',
            ])
            ->assertCreated()
            ->json('data');

        $admin->update(['workspace_id' => $workspace['id']]);

        $employeeOne = $this->employee([
            'username' => 'employee_one',
            'email' => 'employee1@example.com',
            'workspace_id' => $workspace['id'],
        ]);
        $employeeTwo = $this->employee([
            'username' => 'employee_two',
            'email' => 'employee2@example.com',
            'workspace_id' => $workspace['id'],
        ]);

        $employeeOne->update(['workspace_id' => $workspace['id']]);
        $employeeTwo->update(['workspace_id' => $workspace['id']]);

        $employeeOneToken = $this->tokenFor($employeeOne, 'Password1!');

        $ownTask = $this->withHeader('Authorization', 'Bearer ' . $employeeOneToken)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspace['id'],
                'title' => 'Employee owned task',
                'description' => 'Created by the employee.',
                'status' => 'todo',
                'priority' => 'medium',
            ])
            ->assertCreated()
            ->json('data');

        $this->assertDatabaseHas('tasks', [
            'id' => $ownTask['id'],
            'created_by_user_id' => $employeeOne->id,
            'assigned_to_user_id' => $employeeOne->id,
        ]);
        $this->assertDatabaseHas('task_assignees', [
            'task_id' => $ownTask['id'],
            'user_id' => $employeeOne->id,
        ]);

        $adminOwnedTask = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspace['id'],
                'title' => 'Admin owned task',
                'description' => 'Assigned to admin and visible to everyone.',
                'status' => 'todo',
                'priority' => 'high',
                'assignee_ids' => [$admin->id],
            ])
            ->assertCreated()
            ->json('data');

        $employeeTwoToken = $this->tokenFor($employeeTwo, 'Password1!');

        $this->withHeader('Authorization', 'Bearer ' . $employeeTwoToken)
            ->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $ownTask['id'],
            ])
            ->assertJsonFragment([
                'id' => $adminOwnedTask['id'],
            ]);

        $this->withHeader('Authorization', 'Bearer ' . $employeeTwoToken)
            ->putJson('/api/tasks/' . $ownTask['id'], [
                'status' => 'in-progress',
            ])
            ->assertStatus(403);

        $this->withHeader('Authorization', 'Bearer ' . $employeeOneToken)
            ->putJson('/api/tasks/' . $ownTask['id'], [
                'status' => 'in-progress',
            ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $ownTask['id'],
            'status' => 'in-progress',
            'completed' => false,
        ]);

        $this->withHeader('Authorization', 'Bearer ' . $employeeTwoToken)
            ->deleteJson('/api/tasks/' . $ownTask['id'])
            ->assertStatus(403);

        $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->putJson('/api/tasks/' . $adminOwnedTask['id'], [
                'status' => 'in-progress',
            ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $adminOwnedTask['id'],
            'status' => 'in-progress',
        ]);

        $this->withHeader('Authorization', 'Bearer ' . $employeeOneToken)
            ->putJson('/api/tasks/' . $adminOwnedTask['id'], [
                'status' => 'done',
            ])
            ->assertStatus(403);

        $this->withHeader('Authorization', 'Bearer ' . $employeeOneToken)
            ->putJson('/api/tasks/' . $ownTask['id'], [
                'status' => 'done',
            ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $ownTask['id'],
            'status' => 'done',
            'completed' => true,
        ]);

        $this->withHeader('Authorization', 'Bearer ' . $employeeOneToken)
            ->deleteJson('/api/tasks/' . $ownTask['id'])
            ->assertOk();

        $this->assertDatabaseMissing('tasks', [
            'id' => $ownTask['id'],
        ]);
    }

    public function test_admins_can_only_manage_tasks_they_created(): void
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

        $adminOneToken = $this->tokenFor($adminOne, 'Admin123!');
        $adminTwoToken = $this->tokenFor($adminTwo, 'Admin123!');

        $task = $this->withHeader('Authorization', 'Bearer ' . $adminOneToken)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspaceOne->id,
                'title' => 'Admin owned task',
                'description' => 'Creator and assignee must match to manage this.',
                'status' => 'todo',
                'priority' => 'medium',
                'assignee_ids' => [$adminOne->id],
            ])
            ->assertCreated()
            ->json('data');

        $this->withHeader('Authorization', 'Bearer ' . $adminTwoToken)
            ->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $task['id'],
            ]);

        $this->withHeader('Authorization', 'Bearer ' . $adminTwoToken)
            ->putJson('/api/tasks/' . $task['id'], [
                'status' => 'in-progress',
            ])
            ->assertStatus(403);

        $this->withHeader('Authorization', 'Bearer ' . $adminTwoToken)
            ->deleteJson('/api/tasks/' . $task['id'])
            ->assertStatus(403);

        $this->withHeader('Authorization', 'Bearer ' . $adminOneToken)
            ->putJson('/api/tasks/' . $task['id'], [
                'status' => 'done',
            ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'id' => $task['id'],
            'status' => 'done',
            'completed' => true,
        ]);

        $this->withHeader('Authorization', 'Bearer ' . $adminOneToken)
            ->postJson('/api/logout')
            ->assertOk();

        $freshAdminOneToken = $this->tokenFor($adminOne, 'Admin123!');

        $this->withHeader('Authorization', 'Bearer ' . $freshAdminOneToken)
            ->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $task['id'],
                'status' => 'done',
            ]);
    }
}
