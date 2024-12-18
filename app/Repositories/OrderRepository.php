<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

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
}
