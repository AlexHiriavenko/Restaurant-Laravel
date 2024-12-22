<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Dish;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;

interface DishServiceInterface
{
  public function findById(int $dishId): Dish;

  public function findBySlug(string $slug): Dish;

  public function getDishesQuery(?string $search): Builder;

  public function getByCategory(int $categoryId): Collection;

  public function getByDiscount(): Collection;

  public function updateDish(int $id, array $data, UploadedFile|null $file): Dish;
}
