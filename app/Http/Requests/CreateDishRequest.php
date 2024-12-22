<?php

namespace App\Http\Requests;

use App\Models\Dish;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateDishRequest extends FormRequest
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
      'slug' => 'required|string|max:255|unique:dishes,slug',
      'description' => 'nullable|string',
      'price' => 'required|numeric|min:0',
      'discount_percent' => 'nullable|integer|min:0|max:100',
      'category_id' => 'required|exists:categories,id',
      'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'modifiers' => 'nullable|array',
      'modifiers.*' => 'integer|exists:modifiers,id', // Каждый ID должен существовать в таблице modifiers
    ];
  }
}
