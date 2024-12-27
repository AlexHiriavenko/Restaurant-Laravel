<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\OrderRepository;
use App\Services\Interfaces\OrderServiceInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Enums\OrderStatusEnum;
use App\Jobs\SendEmailOrderReady;
use App\Events\OrderStatusUpdated;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class OrderService implements OrderServiceInterface
{
    private $orderRepository;

    protected $statuses = [
        'done' => 'виконано',
        'in_progress' => 'готуєтся',
        'rejected' => 'відмінено',
    ];

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

            $notification = Notification::create([
                'user_id' => $order->user_id,
                'text' => "Статус вашого замовлення id {$order->id} змінено на {$this->statuses[$order->status]}",
                'was_read' => false,
            ]);

            broadcast(new OrderStatusUpdated($notification->text, $notification->id, $order->id, $order->status));

            return $order;
        });
    }

    public function getUserOrders(int $userId): Collection
    {
        return $this->orderRepository->getOrdersByUserId($userId);
    }

    public function updateStatus(int $orderId, OrderStatusEnum $status): void
    {

        $order = Order::findOrFail($orderId);

        $this->orderRepository->update($orderId, ['status' => $status->value]);

        $notification = Notification::create([
            'user_id' => $order->user_id,
            'text' => "Статус вашого замовлення id {$order->id} змінено на {$this->statuses[$status->value]}",
            'was_read' => false,
        ]);

        // Запуск события
        broadcast(new OrderStatusUpdated($notification->text, $notification->id, $order->id, $status->value));

        // Отправка email при завершении заказа
        if ($status->value === 'done') {

            $subject = 'Order Completed!';
            $template = 'emails.orderComplete';
            $user = User::findOrFail($order->user_id);
            // $email = $user->email;
            $email = 'martmarchmartmarch@gmail.com';
            $userName = $user->name;

            SendEmailOrderReady::dispatch(
                $email,
                $subject,
                $template,
                ['name' => $userName]
            );
        }
    }

    public function getOrders(?OrderStatusEnum $status, ?string $startDate, ?string $endDate, int $perPage = 5): LengthAwarePaginator
    {
        $status = $status?->value ?? null;
        return $this->orderRepository->getOrders($status, $startDate, $endDate, $perPage);
    }
}
