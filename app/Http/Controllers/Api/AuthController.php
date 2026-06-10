<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

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

        $user->forceFill(['last_login_at' => now()])->save();

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'token_type' => 'Bearer',
            'token' => $token,
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
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out.']);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()->load(['workspace', 'team']),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'Profile updated.',
            'user' => $user->fresh()->load(['workspace', 'team']),
        ]);
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $user = $request->user();

        if (! Hash::check($validated['current_password'], $user->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.',
                'errors' => ['current_password' => ['The current password is incorrect.']],
            ], 422);
        }

        $user->update(['password' => $validated['password']]);

        return response()->json(['message' => 'Password updated.']);
    }

    public function updatePreferences(Request $request)
    {
        $validated = $request->validate([
            'timezone' => ['sometimes', 'string', 'max:64'],
            'language' => ['sometimes', 'string', 'max:10'],
            'notifications' => ['sometimes', 'array'],
            'notifications.email' => ['sometimes', 'boolean'],
            'notifications.push' => ['sometimes', 'boolean'],
            'notifications.task_updates' => ['sometimes', 'boolean'],
        ]);

        $user = $request->user();
        $current = $user->preferences ?? [];
        $merged = array_replace_recursive($current, $validated);

        $user->update(['preferences' => $merged]);

        return response()->json([
            'message' => 'Preferences updated.',
            'preferences' => $merged,
        ]);
    }

    public function switchWorkspace(Request $request)
    {
        $user = $request->user();

        if ($user->role !== 'admin') {
            throw new HttpResponseException(response()->json([
                'message' => 'Forbidden.',
            ], 403));
        }

        $validated = $request->validate([
            'workspace_id' => ['required', Rule::exists('workspaces', 'id')],
        ]);

        $user->forceFill([
            'workspace_id' => $validated['workspace_id'],
        ])->save();

        return response()->json([
            'message' => 'Workspace switched.',
            'user' => $user->fresh()->load(['workspace', 'team']),
        ]);
    }
}
