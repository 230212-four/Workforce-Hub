<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $identifier = Str::lower(trim($validated['identifier']));

        $user = User::query()
            ->whereRaw('LOWER(email) = ?', [$identifier])
            ->orWhereRaw('LOWER(username) = ?', [$identifier])
            ->first();

        if (! $user || ! $user->is_active) {
            return response()->json([
                'message' => 'Your account is inactive. Contact an administrator for access.',
            ], 403);
        }

        if (! Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'message' => 'We could not sign you in with those credentials.',
                'errors' => [
                    'identifier' => ['The email address or username is incorrect.'],
                    'password' => ['The password is incorrect.'],
                ],
            ], 422);
        }

        $plainToken = Str::random(80);
        $user->forceFill([
            'api_token_hash' => hash('sha256', $plainToken),
            'last_login_at' => now(),
        ])->save();

        return response()->json([
            'message' => 'Login successful.',
            'token_type' => 'Bearer',
            'token' => $plainToken,
            'user' => $user->load(['workspace', 'team']),
        ]);
    }

    public function register(RegisterAdminRequest $request)
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'admin',
            'is_active' => true,
        ]);

        return response()->json([
            'message' => 'Admin account created.',
            'data' => $user->load(['workspace', 'team']),
        ], 201);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $user->forceFill(['api_token_hash' => null])->save();
        }

        return response()->json(['message' => 'Logged out.']);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()->load(['workspace', 'team']),
        ]);
    }
}
