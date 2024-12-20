<?php

namespace App\Policies;

use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        // доступ ко всем заказам если есть права
        return $user->can('manage_all_orders');
    }

    public function view(User $user, int $id): bool
    {
        // доступ только к своим заказам или любым если есть права
        return $id === $user->id || $user->can('manage_all_orders');
    }
}
