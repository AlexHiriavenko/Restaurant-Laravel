<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use App\Enums\OrderStatusEnum;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderServiceInterface
{
    public function createOrder(array $data): Order;

    public function getOrders(?OrderStatusEnum $status, ?string $startDate, ?string $endDate, int $perPage): LengthAwarePaginator;

    public function getUserOrders(int $userId): Collection;

    public function updateStatus(int $orderId, OrderStatusEnum $status): void;
}
