<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Collection;

class AnalyticsRepository
{
  /**
   * Получить элементы по заданному параметру (ТОП или Аутсайдеры).
   *
   * @param int $quantity Количество позиций в результате
   * @param string $byParam Параметр для сортировки ('total_price' или 'quantity')
   * @param string $startDate Начало периода
   * @param string $endDate Конец периода
   * @param string $type Тип выборки ('top' или 'outsider')
   * @return Collection
   */
  public function getItems(
    int $quantity,
    string $byParam,
    string $startDate,
    string $endDate,
    string $type = 'top'
  ): Collection {
    // Определяем порядок сортировки в зависимости от типа выборки
    $order = $type === 'top' ? 'desc' : 'asc';

    return Order::whereBetween('created_at', [$startDate, $endDate])
      ->with(['items'])
      ->get()
      ->flatMap->items
      ->groupBy('dish_id') // Группируем по блюду
      ->map(function ($items) use ($byParam) {
        return [
          'dish_id' => $items->first()->dish_id,
          'name' => $items->first()->name,
          $byParam => $items->sum($byParam), // Суммируем по переданному параметру
        ];
      })
      ->sortBy($byParam, SORT_REGULAR, $order === 'desc') // Сортируем по параметру
      ->take($quantity); // Берем только N записей
  }

  public function getTotalSales(string $startDate, string $endDate): float
  {
    return Order::whereBetween('created_at', [$startDate, $endDate])
      ->sum('total_price');
  }
}
