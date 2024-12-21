<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Пользователь, сделавший заказ
            $table->string('phone');                                                 // tel   
            $table->string('address')->nullable();                                   // Адрес доставки (nullable для самовывоза)
            $table->string('type');                                                  // Тип заказа (доставка или самовывоз)
            $table->string('status')->default('in_progress');                        // Статус заказа
            $table->decimal('total_price', 10, 2);                                   // Общая сумма заказа
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
