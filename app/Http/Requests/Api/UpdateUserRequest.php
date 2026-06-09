<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;
        $workspaceId = $this->input('workspace_id') ?: $this->route('user')?->workspace_id;

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'username' => ['sometimes', 'required', 'string', 'alpha_dash', 'max:255', Rule::unique('users', 'username')->ignore($userId)],
            'email' => ['sometimes', 'required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($userId)],
            'password' => ['nullable', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['nullable', 'string', 'max:50'],
            'role' => ['sometimes', 'required', Rule::in(['admin', 'user'])],
            'workspace_id' => ['sometimes', 'required', 'exists:workspaces,id'],
            'team_id' => [
                'nullable',
                Rule::exists('teams', 'id')->where(fn ($query) => $query->where('workspace_id', $workspaceId)),
            ],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
