<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Связь с заказом
            $table->foreignId('dish_id')->constrained('dishes')->onDelete('cascade'); // Связь с блюдом
            $table->integer('quantity'); // Количество
            $table->decimal('price', 10, 2); // Цена за единицу
            $table->decimal('total_price', 10, 2); // Итоговая цена за количество
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
