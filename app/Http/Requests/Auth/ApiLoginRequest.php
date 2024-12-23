<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешаем всем выполнять запрос
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
            'rememberMe' => 'nullable|boolean', // Необязательное поле
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email обов\'язковий для заповнення.',
            'email.email' => 'Email має бути коректною електронною адресою.',
            'password.required' => 'Пароль обов\'язковий.',
        ];
    }
}
