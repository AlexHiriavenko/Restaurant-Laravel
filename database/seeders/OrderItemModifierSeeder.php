<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\OrderItemModifier;
use App\Models\Modifier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderItemModifierSeeder extends Seeder
{
  public function run()
  {

    // Отключаем проверку внешних ключей
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Проверяем, существует ли таблица
    if (Schema::hasTable('order_item_modifiers')) {
      // Очистка таблицы перед заполнением
      OrderItemModifier::truncate();
    }


    // Для каждого OrderItem создаем модификаторы
    OrderItem::all()->each(function ($orderItem) {
      $dishModifiers = DB::table('dish_modifiers')
        ->where('dish_id', $orderItem->dish_id)
        ->pluck('modifier_id');

      foreach ($dishModifiers as $modifierId) {
        $modifier = Modifier::find($modifierId);
        if ($modifier) {
          OrderItemModifier::create([
            'order_item_id' => $orderItem->id,
            'modifier_id' => $modifier->id,
            'name' => $modifier->name,
            'price' => $modifier->price,
          ]);
        }
      }
    });
    // Включаем проверки внешних ключей обратно
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
