<?php

namespace App\Http\Requests;

use App\Models\Dish;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateDishRequest extends FormRequest
{
  public function authorize(): bool
  {
    /** @var User $user */
    $user = Auth::user();

    return $user->can('updateAny', Dish::class);
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'slug' => 'required|string|max:255|unique:dishes,slug,' . $this->route('id'),
      'description' => 'nullable|string',
      'price' => 'required|numeric|min:0',
      'discount_percent' => 'nullable|numeric|min:0|max:70',
      'category_id' => 'nullable|exists:categories,id',
      'img' => 'nullable|image|max:2048',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'The name field is required.',
      'slug.required' => 'The slug field is required.',
      'slug.unique' => 'The slug must be unique.',
      'price.required' => 'The price field is required.',
      'price.numeric' => 'The price must be a number.',
      'price.min' => 'The price must be at least 0.',
      'discount_percent.numeric' => 'The discount percent must be a number.',
      'discount_percent.min' => 'The discount percent cannot be less than 0.',
      'discount_percent.max' => 'The discount percent cannot be more than 70.',
      'category_id.exists' => 'The selected category does not exist.',
      'img.image' => 'The uploaded file must be an image.',
      'img.max' => 'The image size must not exceed 2MB.',
    ];
  }
}
