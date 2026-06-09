<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkspaceController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('api.token')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('admin.api')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('workspaces', WorkspaceController::class);
        Route::apiResource('teams', TeamController::class);
    });

    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('notifications', NotificationController::class);
});
