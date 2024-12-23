<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemModifier;

class CalculateTotalPriceSeeder extends Seeder
{
  public function run()
  {
    // 1. Рассчитываем total_price для order_items
    OrderItem::all()->each(function ($orderItem) {
      $modifiers = OrderItemModifier::where('order_item_id', $orderItem->id)->get();

      $modifierTotal = $modifiers->sum(function ($modifier) use ($orderItem) {
        return $modifier->price * $orderItem->quantity;
      });

      $orderItem->total_price = ($orderItem->price * $orderItem->quantity) + $modifierTotal;
      $orderItem->save();
    });

    // 2. Рассчитываем total_price для orders
    Order::all()->each(function ($order) {
      $order->total_price = OrderItem::where('order_id', $order->id)
        ->sum('total_price');
      $order->save();
    });
  }
}
