<?php

namespace App\Repositories;

use App\Models\Modifier;
use App\Repositories\Interfaces\ModifierRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ModifierRepository
{
  public function all(): Collection
  {
    return Modifier::all();
  }
}
