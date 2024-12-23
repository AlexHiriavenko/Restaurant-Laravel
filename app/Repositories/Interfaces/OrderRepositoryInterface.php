<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function create(array $data): Order;

    public function getOrders(?string $status, ?string $startDate, ?string $endDate, int $perPage): LengthAwarePaginator;

    public function getOrdersByUserId(int $userId): Collection;

    public function update(int $id, array $attributes): void;
}
