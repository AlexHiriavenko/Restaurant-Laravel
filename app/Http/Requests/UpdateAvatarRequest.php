<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'avatar' => 'required|file|mimes:jpeg,png,jpg,webp|max:2048', // Максимум 2MB
    ];
  }

  public function messages(): array
  {
    return [
      'avatar.required' => 'Avatar is required.',
      'avatar.mimes' => 'Only JPEG, PNG, JPG files are allowed.',
      'avatar.max' => 'The avatar size must not exceed 2MB.',
    ];
  }
}
