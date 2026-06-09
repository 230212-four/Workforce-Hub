<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Enter the administrator name.',
            'username.required' => 'Choose a username.',
            'username.alpha_dash' => 'Usernames may only include letters, numbers, dashes, and underscores.',
            'username.unique' => 'That username is already in use.',
            'email.required' => 'Enter an email address.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'That email address is already registered.',
            'password.required' => 'Create a password.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
