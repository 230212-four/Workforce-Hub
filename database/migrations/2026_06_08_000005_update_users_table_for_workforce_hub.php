<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('name');
            $table->string('department')->nullable()->after('phone');
            $table->string('role')->default('user')->after('department');
            $table->foreignId('workspace_id')->nullable()->after('role')->constrained('workspaces')->nullOnDelete();
            $table->foreignId('team_id')->nullable()->after('workspace_id')->constrained('teams')->nullOnDelete();
            $table->string('api_token_hash', 64)->nullable()->unique()->after('remember_token');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('team_id');
            $table->dropConstrainedForeignId('workspace_id');
            $table->dropUnique(['api_token_hash']);
            $table->dropColumn(['phone', 'department', 'role', 'api_token_hash']);
        });
    }
};
