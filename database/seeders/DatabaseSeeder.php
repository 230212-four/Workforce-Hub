<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@workforcehub.com')],
            [
                'name' => env('ADMIN_NAME', 'System Admin'),
                'username' => env('ADMIN_USERNAME', 'admin'),
                'password' => env('ADMIN_PASSWORD', 'Admin123!'),
                'role' => 'admin',
                'department' => 'Administration',
                'is_active' => true,
            ]
        );
    }
}
