<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthAndUserManagementTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(array $overrides = []): User
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

    public function test_logs_in_with_a_username_or_email_and_rejects_bad_credentials(): void
    {
        $user = User::query()->create([
            'name' => 'Jane Doe',
            'username' => 'jane_doe',
            'email' => 'jane@example.com',
            'password' => 'Password1!',
            'role' => 'user',
            'is_active' => true,
        ]);

        $this->postJson('/api/login', [
            'identifier' => 'jane_doe',
            'password' => 'Password1!',
        ])
            ->assertOk()
            ->assertJsonPath('user.id', $user->id);

        $this->postJson('/api/login', [
            'identifier' => 'jane@example.com',
            'password' => 'wrong-password',
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['identifier', 'password']);
    }

    public function test_creates_an_admin_account_through_the_registration_endpoint(): void
    {
        $this->postJson('/api/register', [
            'name' => 'New Admin',
            'username' => 'new_admin',
            'email' => 'newadmin@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ])
            ->assertCreated()
            ->assertJsonPath('data.role', 'admin');

        $this->assertDatabaseHas('users', [
            'email' => 'newadmin@example.com',
            'username' => 'new_admin',
            'role' => 'admin',
        ]);
    }

    public function test_prevents_duplicate_usernames_and_emails(): void
    {
        $workspace = Workspace::query()->create([
            'name' => 'People Ops',
            'status' => 'active',
        ]);

        User::query()->create([
            'name' => 'Existing User',
            'username' => 'existing_user',
            'email' => 'existing@example.com',
            'password' => 'Password1!',
            'role' => 'user',
            'is_active' => true,
        ]);

        $admin = $this->adminUser();

        $token = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/users', [
                'name' => 'Another User',
                'username' => 'existing_user',
                'email' => 'existing@example.com',
                'password' => 'Password1!',
                'password_confirmation' => 'Password1!',
                'role' => 'user',
                'workspace_id' => $workspace->id,
            ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['username', 'email']);
    }

    public function test_admins_can_manage_users_and_inactive_accounts_cannot_log_in(): void
    {
        $admin = $this->adminUser();
        $workspace = Workspace::query()->create([
            'name' => 'Operations',
            'status' => 'active',
        ]);

        $token = $this->postJson('/api/login', [
            'identifier' => $admin->email,
            'password' => 'Admin123!',
        ])->json('token');

        $created = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->postJson('/api/users', [
                'name' => 'Employee One',
                'username' => 'employee_one',
                'email' => 'employee@example.com',
                'password' => 'Password1!',
                'password_confirmation' => 'Password1!',
                'role' => 'user',
                'workspace_id' => $workspace->id,
                'is_active' => true,
            ])
            ->assertCreated()
            ->json('data');

        $this->assertSame('employee@example.com', $created['email']);

        $this->withHeader('Authorization', 'Bearer ' . $token)
            ->putJson('/api/users/' . $created['id'], [
                'is_active' => false,
            ])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);

        $this->postJson('/api/login', [
            'identifier' => 'employee_one',
            'password' => 'Password1!',
        ])
            ->assertStatus(403);
    }
}
