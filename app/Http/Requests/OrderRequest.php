<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();
        $userId = $this->defineUserId();

        return $user->can('view', [Order::class, $userId]);
    }

    public function defineUserId(): int
    {
        return (int) ($this->route('id') ?? Auth::id());
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|integer',
        ];
    }
}
