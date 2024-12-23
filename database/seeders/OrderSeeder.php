<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
  public function run()
  {
    // Отключаем проверку внешних ключей
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Проверяем, существует ли таблица
    if (Schema::hasTable('orders')) {
      // Очистка таблицы перед заполнением
      Order::truncate();
    }

    // Генерация случайных заказов
    Order::factory(300)->create();
    // Включаем проверки внешних ключей обратно
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
