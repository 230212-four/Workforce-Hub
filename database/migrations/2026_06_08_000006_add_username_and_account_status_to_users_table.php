<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
            $table->boolean('is_active')->default(true)->after('role');
            $table->timestamp('last_login_at')->nullable()->after('api_token_hash');
        });

        DB::table('users')->orderBy('id')->get()->each(function ($user) {
            $baseUsername = Str::slug($user->username ?: $user->name ?: 'user');
            $username = $baseUsername !== '' ? $baseUsername : 'user-' . $user->id;
            $candidate = $username;
            $suffix = 1;

            while (DB::table('users')->where('username', $candidate)->where('id', '!=', $user->id)->exists()) {
                $candidate = $username . '-' . $suffix++;
            }

            DB::table('users')->where('id', $user->id)->update([
                'username' => $candidate,
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'is_active', 'last_login_at']);
        });
    }
};
