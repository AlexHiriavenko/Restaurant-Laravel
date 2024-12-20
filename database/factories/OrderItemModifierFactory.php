<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Modifier;
use App\Models\OrderItemModifier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItemModifier>
 */
class OrderItemModifierFactory extends Factory
{
  protected $model = OrderItemModifier::class;

  public function definition(): array
  {
    return [
      'order_item_id' => null, // Заполним в сидере
      'modifier_id' => null, // Заполним в сидере
      'name' => null, // Заполним в сидере
      'price' => null, // Заполним в сидере
    ];
  }
}
