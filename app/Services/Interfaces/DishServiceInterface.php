<?php

namespace App\Services\Interfaces;

use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dish;

interface DishServiceInterface
{
  public function findById(int $dishId): Dish;

  public function findBySlug(string $slug): Dish;

  public function getDishesWithPagination(?string $search, int $perPage): CursorPaginator;

  public function getByCategory(int $categoryId): Collection;

  public function getByDiscount(): Collection;
}
