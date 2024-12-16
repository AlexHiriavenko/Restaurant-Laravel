<?php

namespace App\Rules;

use App\Services\BookingService;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeOverlapRule implements ValidationRule
{
    protected $tableId;
    protected $date;

    public function __construct($tableId, $date)
    {
        $this->tableId = $tableId;
        $this->date = $date;
    }

    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        // Получаем бронирования для конкретного столика и даты
        $bookingService = app(BookingService::class);
        $existingReservations = $bookingService->getReservationsByTableIdWithDate($this->tableId, $this->date);

        // Проверяем пересечение времени
        foreach ($existingReservations as $reservation) {
            if ($value < $reservation->end_time && request('end_time') > $reservation->start_time) {
                $fail('Обраний час перетинається з існуючим бронюванням.');
            }
        }
    }
}
