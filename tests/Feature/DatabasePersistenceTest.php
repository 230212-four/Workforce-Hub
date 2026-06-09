<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabasePersistenceTest extends TestCase
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

    public function test_admin_can_create_workspace_and_it_persists(): void
    {
        $admin = $this->admin();

        $token = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $workspace = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/workspaces', [
                'name' => 'Launch Hub',
                'description' => 'Workspace created through the admin panel.',
                'status' => 'active',
            ])
            ->assertCreated()
            ->json('data');

        $this->assertDatabaseHas('workspaces', [
            'id' => $workspace['id'],
            'name' => 'Launch Hub',
            'created_by_user_id' => $admin->id,
        ]);
    }

    public function test_task_assignees_are_limited_to_the_same_workspace(): void
    {
        $admin = $this->admin();
        $workspaceOne = $this->withHeader('Authorization', 'Bearer ' . $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token'))
            ->postJson('/api/workspaces', [
                'name' => 'Workspace One',
                'status' => 'active',
            ])
            ->assertCreated()
            ->json('data');

        $workspaceTwo = Workspace::query()->create([
            'name' => 'Workspace Two',
            'status' => 'active',
        ]);

        $admin->update(['workspace_id' => $workspaceOne['id']]);

        $memberInWorkspaceOne = $this->employee([
            'username' => 'member_one',
            'email' => 'member1@example.com',
            'workspace_id' => $workspaceOne['id'],
        ]);

        $memberInWorkspaceTwo = $this->employee([
            'username' => 'member_two',
            'email' => 'member2@example.com',
            'workspace_id' => $workspaceTwo->id,
        ]);

        $token = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspaceOne['id'],
                'title' => 'Team task',
                'status' => 'todo',
                'priority' => 'medium',
                'assignee_ids' => [$memberInWorkspaceOne->id, $memberInWorkspaceTwo->id],
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['assignee_ids.1']);

        $task = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspaceOne['id'],
                'title' => 'Team task',
                'status' => 'todo',
                'priority' => 'medium',
                'assignee_ids' => [$memberInWorkspaceOne->id],
            ])
            ->assertCreated()
            ->json('data');

        $this->assertDatabaseHas('task_assignees', [
            'task_id' => $task['id'],
            'user_id' => $memberInWorkspaceOne->id,
        ]);
        $this->assertDatabaseMissing('task_assignees', [
            'task_id' => $task['id'],
            'user_id' => $memberInWorkspaceTwo->id,
        ]);
    }

    public function test_tasks_persist_with_multiple_assignees_and_are_visible_to_assigned_users(): void
    {
        $admin = $this->admin();
        $employeeOne = $this->employee([
            'username' => 'employee_one',
            'email' => 'employee1@example.com',
        ]);
        $employeeTwo = $this->employee([
            'username' => 'employee_two',
            'email' => 'employee2@example.com',
        ]);

        $adminToken = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $workspace = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->postJson('/api/workspaces', [
                'name' => 'Operations',
                'description' => 'Operations workspace',
                'status' => 'active',
            ])
            ->assertCreated()
            ->json('data');

        $admin->update(['workspace_id' => $workspace['id']]);
        $employeeOne->update(['workspace_id' => $workspace['id']]);
        $employeeTwo->update(['workspace_id' => $workspace['id']]);

        $task = $this->withHeader('Authorization', 'Bearer ' . $adminToken)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspace['id'],
                'title' => 'Prepare onboarding pack',
                'description' => 'Task should persist in the database.',
                'status' => 'todo',
                'priority' => 'high',
                'assignee_ids' => [$employeeOne->id, $employeeTwo->id],
            ])
            ->assertCreated()
            ->json('data');

        $this->assertDatabaseHas('task_assignees', [
            'task_id' => $task['id'],
            'user_id' => $employeeOne->id,
        ]);
        $this->assertDatabaseHas('task_assignees', [
            'task_id' => $task['id'],
            'user_id' => $employeeTwo->id,
        ]);

        $employeeToken = $this->postJson('/api/login', [
            'identifier' => $employeeOne->email,
            'password' => 'Password1!',
        ])->json('token');

        $this->withHeader('Authorization', 'Bearer ' . $employeeToken)
            ->getJson('/api/tasks')
            ->assertOk()
            ->assertJsonFragment(['title' => 'Prepare onboarding pack']);
    }

    public function test_task_and_workspace_deletions_update_the_database(): void
    {
        $admin = $this->admin();

        $token = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $workspace = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/workspaces', [
                'name' => 'Archive Room',
                'status' => 'active',
            ])
            ->assertCreated()
            ->json('data');

        $task = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspace['id'],
                'title' => 'Delete me',
                'status' => 'todo',
                'priority' => 'medium',
                'assignee_ids' => [$admin->id],
            ])
            ->assertCreated()
            ->json('data');

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson('/api/tasks/' . $task['id'])
            ->assertOk();

        $this->assertDatabaseMissing('tasks', ['id' => $task['id']]);
        $this->assertDatabaseMissing('task_assignees', ['task_id' => $task['id']]);

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->deleteJson('/api/workspaces/' . $workspace['id'])
            ->assertOk();

        $this->assertDatabaseMissing('workspaces', ['id' => $workspace['id']]);
    }

    public function test_notifications_are_created_for_system_actions_and_loaded_from_the_database(): void
    {
        $admin = $this->admin();
        $employee = $this->employee();

        $token = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $workspace = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/workspaces', [
                'name' => 'Notifications',
                'status' => 'active',
            ])
            ->assertCreated()
            ->json('data');

        $admin->update(['workspace_id' => $workspace['id']]);
        $employee->update(['workspace_id' => $workspace['id']]);

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/tasks', [
                'workspace_id' => $workspace['id'],
                'title' => 'Notify the team',
                'status' => 'todo',
                'priority' => 'medium',
                'assignee_ids' => [$employee->id],
            ])
            ->assertCreated();

        $this->assertDatabaseHas('notifications', [
            'user_id' => $employee->id,
            'title' => 'New task assigned',
        ]);

        $employeeToken = $this->postJson('/api/login', [
            'identifier' => $employee->email,
            'password' => 'Password1!',
        ])->json('token');

        $this->withHeader('Authorization', 'Bearer ' . $employeeToken)
            ->getJson('/api/notifications')
            ->assertOk()
            ->assertJsonFragment(['title' => 'New task assigned']);
    }
}
