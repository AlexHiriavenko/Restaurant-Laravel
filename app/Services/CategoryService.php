<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Interfaces\CategoryServiceInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
  protected CategoryRepositoryInterface $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function getAllCategories(): Collection
  {
    return $this->categoryRepository->all();
  }

  public function getCategoryById(int $id): ?Category
  {
    return $this->categoryRepository->find($id);
  }

  public function createCategory(array $data): Category
  {
    return $this->categoryRepository->create($data);
  }

  public function updateCategory(int $id, array $data): Category
  {
    return $this->categoryRepository->update($id, $data);
  }

  public function deleteCategory(int $id): void
  {
    $this->categoryRepository->delete($id);
  }
}
