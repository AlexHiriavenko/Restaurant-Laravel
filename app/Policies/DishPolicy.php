<?php

namespace App\Policies;

use App\Models\User;

class DishPolicy
{
  public function updateAny(User $user): bool
  {
    return $user->can('manage_dishes');
  }
}
