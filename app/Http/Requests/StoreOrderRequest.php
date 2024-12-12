<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{

  public function authorize(): bool
  {
    return true;
  }

  public function rules()
  {
    return [
      'phone' => 'required|string|regex:/^[+0-9]{10,13}$/',
      'address' => 'nullable|string',
      'deliveryType' => 'required|in:delivery,pickup',
      'total' => 'required|numeric|min:0',
      'dishes' => 'required|array|min:1',
      'dishes.*.id' => 'required|exists:dishes,id',
      'dishes.*.quantity' => 'required|integer|min:1',
      'dishes.*.price' => 'required|numeric|min:0',
      'dishes.*.total' => 'required|numeric|min:0',
      'dishes.*.modifiers' => 'array',
      'dishes.*.modifiers.*.id' => 'required|exists:modifiers,id',
      'dishes.*.modifiers.*.name' => 'nullable|string',
      'dishes.*.modifiers.*.price' => 'numeric|min:0',
    ];
  }

  public function messages()
  {
    return [
      'phone.required' => 'Номер телефону є обов’язковим.',
      'phone.regex' => 'не вірний формат номеру телефону',
      'phone.string' => 'не вірний тип даних для Номер телефону.',
      'address.string' => 'не вірний тип даних для Адреса.',
      'deliveryType.required' => 'Тип доставки є обов’язковим.',
      'deliveryType.in' => 'Тип доставки повинен бути або "delivery", або "pickup".',
      'dishes.required' => 'Має бути додано хоча б одну страву.',
      'dishes.array' => 'не вірний тип даних для Страви.',
      'dishes.*.id.exists' => 'Обрана страва не існує.',
      'dishes.*.quantity.integer' => 'Кількість повинна бути числом.',
      'dishes.*.quantity.min' => 'Кількість страв повинна бути щонайменше 1.',
      'dishes.*.modifiers.array' => 'не вірний тип даних для Модифікатори',
      'dishes.*.modifiers.*.id.exists' => 'Обраний модифікатор не існує.',
    ];
  }
}
