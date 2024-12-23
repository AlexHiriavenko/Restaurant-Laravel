<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\OrderStatusEnum;

class OrderSearchRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'status' => ['nullable', Rule::in(array_column(OrderStatusEnum::cases(), 'value'))],
      'start_date' => ['nullable', 'date', 'before_or_equal:end_date'],
      'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
      'per_page' => ['nullable', 'integer', 'min:1', 'max:20'],
    ];
  }

  public function messages(): array
  {
    return [
      'status.in' => 'Invalid status value.',
      'start_date.date' => 'Start date must be a valid date.',
      'end_date.date' => 'End date must be a valid date.',
      'start_date.before_or_equal' => 'Start date must be before or equal to the end date.',
      'end_date.after_or_equal' => 'End date must be after or equal to the start date.',
      'per_page.integer' => 'Per page must be an integer.',
      'per_page.min' => 'Per page must be at least 1.',
      'per_page.max' => 'Per page must not exceed 20.',
    ];
  }
}
