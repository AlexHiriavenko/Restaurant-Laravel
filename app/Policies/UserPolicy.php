<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function updateAny(User $user): bool
    {
        return $user->can('manage_users');
    }
}
