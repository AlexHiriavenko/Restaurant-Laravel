<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

interface CategoryServiceInterface
{
  public function getAllCategories(): Collection;

  public function getCategoryById(int $id): ?Category;

  public function createCategory(array $data): Category;

  public function updateCategory(int $id, array $data): Category;

  public function deleteCategory(int $id): void;
}
