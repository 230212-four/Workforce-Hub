<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $workspaceId = $this->input('workspace_id');

        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['nullable', 'string', 'max:50'],
            'role' => ['required', Rule::in(['admin', 'user'])],
            'workspace_id' => ['required', 'exists:workspaces,id'],
            'team_id' => [
                'nullable',
                Rule::exists('teams', 'id')->where(fn ($query) => $query->where('workspace_id', $workspaceId)),
            ],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Enter the person\'s name.',
            'username.required' => 'Choose a username.',
            'username.alpha_dash' => 'Usernames may only include letters, numbers, dashes, and underscores.',
            'username.unique' => 'That username is already taken.',
            'email.required' => 'Enter an email address.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'That email address is already in use.',
            'password.required' => 'Create a password.',
            'workspace_id.required' => 'Choose a workspace for this user.',
            'role.required' => 'Choose an account role.',
            'role.in' => 'Select a valid account role.',
        ];
    }
}
