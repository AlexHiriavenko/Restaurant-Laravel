<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

interface CategoryRepositoryInterface
{
  public function all(): Collection;

  public function find(int $id): ?Category;

  public function create(array $data): Category;

  public function update(int $id, array $data): Category;

  public function delete(int $id): void;
}
