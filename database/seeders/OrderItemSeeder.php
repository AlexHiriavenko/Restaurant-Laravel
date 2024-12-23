<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Schema;

class OrderItemSeeder extends Seeder
{
  public function run()
  {

    // Отключаем проверку внешних ключей
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Проверяем, существует ли таблица
    if (Schema::hasTable('order_items')) {
      // Очистка таблицы перед заполнением
      OrderItem::truncate();
    }

    $orders = Order::all();

    foreach ($orders as $order) {
      OrderItem::factory(fake()->numberBetween(1, 3))->create([
        'order_id' => $order->id,
      ]);
    }
    // Включаем проверки внешних ключей обратно
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
