<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $userCount = User::count();

        $startDate = now()->subMonth()->startOfMonth(); // Первое число прошлого месяца
        $endDate = now()->endOfMonth(); // Последний день текущего месяца

        return [
            'user_id' => fake()->numberBetween(1, $userCount),
            'phone' => fake()->numerify('##########'),
            'address' => null, // Для самовывоза адрес не требуется
            'type' => 'pickup', // Тип заказа всегда самовывоз
            'status' => 'done', // Статус всегда выполнен
            'total_price' => 0, // Пока что 0
            'created_at' => fake()->dateTimeBetween($startDate, $endDate), // Рандомная дата в указанном диапазоне
            'updated_at' => now(), // Текущая дата и время
        ];
    }
}
