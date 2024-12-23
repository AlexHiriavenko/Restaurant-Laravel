<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:20',
        ];
    }
}
