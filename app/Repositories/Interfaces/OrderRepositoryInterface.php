<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;

interface OrderRepositoryInterface
{
    public function create(array $data): Order;

    public function getOrdersByUserId(int $userId): Collection;
}
