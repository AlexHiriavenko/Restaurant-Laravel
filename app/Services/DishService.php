<?php

namespace App\Services;

use App\Repositories\Interfaces\DishRepositoryInterface;
use App\Services\Interfaces\DishServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Dish;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;

class DishService implements DishServiceInterface
{
  protected DishRepositoryInterface $dishRepository;
  protected FileService $fileService;

  public function __construct(DishRepositoryInterface $dishRepository, FileService $fileService)
  {
    $this->dishRepository = $dishRepository;
    $this->fileService = $fileService;
  }

  public function findById(int $dishId): Dish
  {
    return $this->dishRepository->find($dishId);
  }

  public function findBySlug(string $slug): Dish
  {
    return $this->dishRepository->findBySlug($slug);
  }

  public function getDishesQuery(?string $search): Builder
  {
    return $this->dishRepository->getDishesQuery($search);
  }

  public function getByCategory(int $categoryId): Collection
  {
    return $this->dishRepository->getByCategory($categoryId);
  }

  public function getByDiscount(): Collection
  {
    return $this->dishRepository->getByDiscount();
  }

  public function updateDish(int $id, array $data, UploadedFile|null $file): Dish
  {
    $dish = $this->dishRepository->find($id);
    $uploadPath = 'imgs/categories/' . $dish->category->slug;
    if ($file) {
      $uploadedPath = $this->fileService->update($file, $dish->img, $uploadPath);
      $data['img'] = $uploadedPath;
    } else {
      $data['img'] = $dish->img;
    }

    $dish->update($data);

    return $dish;
  }
}
