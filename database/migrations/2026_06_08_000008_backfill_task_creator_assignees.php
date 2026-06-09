<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            $tasks = DB::table('tasks')
                ->select('id', 'created_by_user_id', 'assigned_to_user_id', 'created_at', 'updated_at')
                ->whereNotNull('created_by_user_id')
                ->get();

            foreach ($tasks as $task) {
                DB::table('task_assignees')->updateOrInsert(
                    [
                        'task_id' => $task->id,
                        'user_id' => $task->created_by_user_id,
                    ],
                    [
                        'created_at' => $task->created_at,
                        'updated_at' => $task->updated_at,
                    ]
                );

                if (empty($task->assigned_to_user_id)) {
                    DB::table('tasks')
                        ->where('id', $task->id)
                        ->update(['assigned_to_user_id' => $task->created_by_user_id]);
                }
            }
        });
    }

    public function down(): void
    {
        DB::transaction(function () {
            DB::table('task_assignees')
                ->join('tasks', 'task_assignees.task_id', '=', 'tasks.id')
                ->whereColumn('task_assignees.user_id', 'tasks.created_by_user_id')
                ->delete();
        });
    }
};
