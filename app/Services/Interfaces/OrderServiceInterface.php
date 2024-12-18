<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;

interface OrderServiceInterface
{
    /**
     * Создать заказ.
     */
    public function createOrder(array $data): Order;

    /**
     * Получить заказы пользователя по его id.
     */
    public function getUserOrders(int $userId): Collection;
}
