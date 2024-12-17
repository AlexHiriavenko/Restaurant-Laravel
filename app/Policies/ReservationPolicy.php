<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;

class ReservationPolicy
{
    public function delete(User $user, Reservation $reservation): bool
    {
        // Пользователь может удалить бронирование, если:
        // - Он владелец бронирования
        // - Или у него есть разрешение manage_reservations
        return $reservation->user_id === $user->id || $user->can('manage_reservations');
    }
}
