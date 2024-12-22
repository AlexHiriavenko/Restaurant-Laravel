<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dish;

interface DishRepositoryInterface
{
  public function find(int $dishId): Dish;

  public function findBySlug(string $slug): Dish;

  public function getByCategory(int $categoryId): Collection;

  public function getByDiscount(): Collection;

  public function getDishesQuery(?string $search): Builder;
}
