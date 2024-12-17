<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;

class ReservationPolicy
{
    public function delete(User $user, Reservation $reservation): bool
    {
        // Пользователь может удалить только свои бронирования или любые если у него есть права
        return $reservation->user_id === $user->id || $user->can('manage_reservations');
    }

    public function viewAny(User $user): bool
    {
        return $user->can('manage_reservations');
    }

    public function view(User $user, int $id): bool
    {
        // доступ только к своим бронированиям или любым если есть права
        return $id === $user->id || $user->can('manage_reservations');
    }
}
