<?php

namespace App\Policies;

use App\Models\User;

class ReportsPolicy
{
  public function view(User $user): bool
  {
    return $user->can('view_reports');
  }
}
