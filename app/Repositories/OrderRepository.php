<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function getOrdersByUserId(int $userId): Collection
    {
        return Order::with([
            'items', // Связь с OrderItem
            'items.modifiers', // Связь с OrderItemModifier через OrderItem
        ])->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
    }

    public function update(int $id, array $attributes): void
    {
        $user = Order::findOrFail($id);
        $user->update($attributes);
    }


    public function getOrders(?string $status, ?string $startDate, ?string $endDate, int $perPage = 5): LengthAwarePaginator
    {
        $query = Order::with('user'); // Загружаем связь 'user'

        // Фильтрация по статусу, если он указан
        if ($status) {
            $query->where('status', $status);
        }

        // Фильтрация по диапазону дат, если указаны
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Сортировка по дате
        $query->orderBy('created_at', 'desc');

        // Пагинация
        return $query->paginate($perPage);
    }
}
