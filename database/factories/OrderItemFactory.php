<?php

namespace Database\Factories;

use App\Models\Dish;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
  protected $model = OrderItem::class;

  public function definition(): array
  {
    $dish = Dish::inRandomOrder()->first(); // Выбираем случайное блюдо

    return [
      'order_id' => null, // Заполним в сидере
      'dish_id' => $dish->id,
      'name' => $dish->name,
      'quantity' => fake()->numberBetween(1, 3),
      'price' => $dish->final_price, // Цена с учетом скидки
      'total_price' => 0, // Пока не заполняем
    ];
  }
}
