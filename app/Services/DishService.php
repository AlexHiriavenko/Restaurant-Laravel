<?php

namespace App\Services;

use App\Repositories\Interfaces\DishRepositoryInterface;
use App\Services\Interfaces\DishServiceInterface;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dish;

class DishService implements DishServiceInterface
{
  protected DishRepositoryInterface $dishRepository;

  public function __construct(DishRepositoryInterface $dishRepository)
  {
    $this->dishRepository = $dishRepository;
  }

  public function findById(int $dishId): Dish
  {
    return $this->dishRepository->find($dishId);
  }

  public function findBySlug(string $slug): Dish
  {
    return $this->dishRepository->findBySlug($slug);
  }

  public function getDishesWithPagination(?string $search, int $perPage): CursorPaginator
  {
    return $this->dishRepository->getDishesWithPagination($search, $perPage);
  }

  public function getByCategory(int $categoryId): Collection
  {
    return $this->dishRepository->getByCategory($categoryId);
  }

  public function getByDiscount(): Collection
  {
    return $this->dishRepository->getByDiscount();
  }
}
