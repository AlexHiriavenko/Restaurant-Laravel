<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TimeOverlapRule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;

class BookingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $user */
        $user = Auth::user();
        $userId = $this->defineUserId();

        return $user->can('view', [Reservation::class, $userId]);
    }

    public function defineUserId(): int
    {
        return (int) ($this->route('id') ?? Auth::id());
    }

    public function rules(): array
    {
        return [
            'table_id' => 'required|integer|exists:tables,id',
            'reservation_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => [
                'required',
                'date_format:H:i',
                'after:09:00',
                'before:22:00',
                new TimeOverlapRule($this->input('table_id'), $this->input('reservation_date'))
            ],
            'end_time' => 'required|date_format:H:i|after:start_time|before:22:00',
            'phone_number' => 'required|string|min:10|max:15',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'table_id.exists' => 'Вказаний стіл не знайдено.',
            'reservation_date.required' => 'Поле "Дата бронювання" є обов’язковим.',
            'reservation_date.date' => 'Поле "Дата бронювання" має бути валідною датою.',
            'reservation_date.after_or_equal' => 'Дата бронювання не може бути в минулому.',
            'start_time.date_format' => 'Поле "Час початку" має бути у форматі HH:mm.',
            'start_time.after' => 'Час початку має бути після 09:00.',
            'start_time.before' => 'Час початку має бути до 22:00.',
            'end_time.date_format' => 'Поле "Час закінчення" має бути у форматі HH:mm.',
            'end_time.after' => 'Час закінчення має бути пізніше за "Час початку".',
            'end_time.before' => 'Час закінчення має бути до 22:00.',
            'phone_number.min' => 'Поле "Номер телефону" має містити щонайменше 10 символів.',
            'phone_number.max' => 'Поле "Номер телефону" має містити не більше 15 символів.',
        ];
    }
}
