<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // // Получаем user_id из запроса или берем ID текущего пользователя
        $requestedUserId = $this->validatedUserId();

        // Если пользователь запрашивает свои заказы, разрешаем
        if ($requestedUserId === auth()->id()) {
            return true;
        }

        /** @var User $user */
        $user = auth()->user();

        // Если пользователь запрашивает чужие заказы, проверяем разрешение
        return $user->can('manage_all_orders');
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer',
        ];
    }

    public function validatedUserId(): int
    {
        // Возвращаем user_id из запроса или текущего пользователя
        return $this->route('id') ?? auth()->id();
    }
}
