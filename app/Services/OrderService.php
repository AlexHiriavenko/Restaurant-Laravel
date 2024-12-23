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
use App\Services\MailService;
use App\Jobs\SendEmailOrderReady;

class OrderService implements OrderServiceInterface
{
    private $orderRepository;
    private $mailService;

    public function __construct(OrderRepository $orderRepository, MailService $mailService)
    {
        $this->orderRepository = $orderRepository;
        $this->mailService = $mailService;
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

    public function updateStatus(int $orderId, OrderStatusEnum $status): void
    {

        $order = Order::findOrFail($orderId);

        $this->orderRepository->update($orderId, ['status' => $status->value]);

        // Отправка email при завершении заказа
        if ($status->value === 'done') {

            $subject = 'Order Completed!';
            $template = 'emails.orderComplete';
            $user = User::findOrFail($order->user_id);
            // $email = $user->email;
            $email = 'martmarchmartmarch@gmail.com';
            $userName = $user->name;

            // $this->mailService->sendHtmlEmail(
            //     $email,
            //     $subject,
            //     $template,
            //     ['name' => $userName] // Данные для шаблона
            // );

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
