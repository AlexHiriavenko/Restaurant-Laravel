<?php

namespace App\Repositories;

use App\Models\Dish;
use App\Repositories\Interfaces\DishRepositoryInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;

class DishRepository implements DishRepositoryInterface
{
  public function find(int $dishId): Dish
  {
    return Dish::with('modifiers', 'category')->findOrFail($dishId);
  }

  public function findBySlug(string $slug): Dish
  {
    return Dish::with('modifiers', 'category')->where('slug', $slug)->firstOrFail();
  }

  public function getByCategory(int $categoryId): Collection
  {
    return Dish::where('category_id', $categoryId)->with('category')->get();
  }

  public function getByDiscount(): Collection
  {
    return Dish::whereNotNull('discount_percent')
      ->where('discount_percent', '>', 0)
      ->get();
  }

  public function getDishesWithPagination(?string $search, int $perPage): CursorPaginator
  {
    $query = Dish::query()->with('category');

    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('description', 'like', "%{$search}%")
          ->orWhereHas('category', function ($categoryQuery) use ($search) {
            $categoryQuery->where('name', 'like', "%{$search}%");
          });
      });
    }

    return $query->orderBy('id')->cursorPaginate($perPage);
  }
}
