<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Поточний пароль обов\'язковий',
            'password.required' => 'Новий пароль обов\'язковий',
            'password.min' => 'Мінімальна довжина пароля — 8 символів',
            'password.confirmed' => 'Паролі не збігаються',
        ];
    }
}
