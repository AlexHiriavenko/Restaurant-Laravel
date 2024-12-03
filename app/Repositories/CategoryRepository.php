<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
  public function all(): Collection
  {
    return Category::all();
  }

  public function find(int $id): ?Category
  {
    return Category::find($id); // Может вернуть null
  }

  public function create(array $data): Category
  {
    return Category::create($data);
  }

  public function update(int $id, array $data): Category
  {
    $category = Category::findOrFail($id); // Найдёт или выбросит исключение
    $category->update($data);
    return $category;
  }

  public function delete(int $id): void
  {
    $category = Category::findOrFail($id); // Найдёт или выбросит исключение
    $category->delete();
  }
}
