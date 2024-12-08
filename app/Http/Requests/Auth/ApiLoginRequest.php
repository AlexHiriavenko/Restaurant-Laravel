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
      'email.required' => 'Email is required.',
      'email.email' => 'Email must be a valid email address.',
      'password.required' => 'Password is required.',
    ];
  }
}
