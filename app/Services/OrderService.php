<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // Создание заказа
            $order = $this->orderRepository->create([
                'user_id' => auth()->id(),
                'phone' => $data['phone'],
                'address' => $data['address'],
                'type' => $data['deliveryType'],
                'status' => 'in_progress',
                'total_price' => $data['total'],
            ]);

            // Создание позиций заказа
            foreach ($data['dishes'] as $dish) {
                $orderItem = new OrderItem([
                    'dish_id' => $dish['id'],
                    'name' => $dish['name'],
                    'quantity' => $dish['quantity'],
                    'price' => $dish['price'],
                    'total_price' => $dish['total'],
                ]);

                $order->items()->save($orderItem);

                // Создание модификаторов для каждой позиции
                foreach ($dish['modifiers'] as $modifier) {
                    $orderItem->modifiers()->create([
                        'modifier_id' => $modifier['id'],
                        'name' => $modifier['name'],
                        'price' => $modifier['price'],
                    ]);
                }
            }

            return $order;
        });
    }

    public function getUserOrders(int $userId): Collection
    {
        return $this->orderRepository->getOrdersByUserId($userId);
    }
}
