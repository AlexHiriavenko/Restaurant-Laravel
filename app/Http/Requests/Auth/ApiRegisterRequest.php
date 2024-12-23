<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ApiRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:5|confirmed',
            'password' => 'required|string|min:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ім\'я обов\'язкове для заповнення.',
            'email.required' => 'Email обов\'язковий для заповнення.',
            'email.email' => 'Вкажіть коректний email.',
            'email.unique' => 'Цей email вже зареєстрований.',
            'password.required' => 'Пароль обов\'язковий.',
            'password.min' => 'Пароль має бути не менше 5 символів.',
            // 'password.confirmed' => 'Пароль та його підтвердження не співпадають.',
            // 'avatar.image' => 'Аватар має бути зображенням.',
        ];
    }
}
