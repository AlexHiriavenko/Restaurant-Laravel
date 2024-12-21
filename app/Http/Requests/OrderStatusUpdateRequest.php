<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\OrderStatusEnum;
use Illuminate\Validation\Rule;

class OrderStatusUpdateRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true; // Проверка авторизации пользователя
  }

  public function rules(): array
  {
    return [
      'order_id' => 'required|integer|exists:orders,id', // Проверка наличия заказа
      'status' => ['required', 'string', Rule::in(OrderStatusEnum::cases())],
    ];
  }

  public function messages(): array
  {
    return [
      'order_id.required' => 'Order ID is required.',
      'order_id.integer' => 'Order ID must be an integer.',
      'order_id.exists' => 'The specified order does not exist.',
      'status.required' => 'The status field is required.',
      'status.string' => 'The status must be a string.',
    ];
  }
}
