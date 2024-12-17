<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\AccessOwnData;

class BookingByUserRequest extends FormRequest
{
  use AccessOwnData;

  protected function getPermission(): string
  {
    return 'manage_reservations';
  }

  public function authorize(): bool
  {
    return $this->can();
  }

  public function rules(): array
  {
    return [
      'user_id' => 'nullable|integer',
    ];
  }
}
