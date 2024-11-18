<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название блюда
            $table->text('description')->nullable(); // Описание блюда
            $table->decimal('price', 8, 2); // Цена
            $table->unsignedTinyInteger('discount')->default(0); // Скидка в %
            $table->decimal('finally_price', 8, 2); // Итоговая цена
            $table->boolean('promo')->default(false); // Промо метка
            $table->string('image')->nullable(); // Путь к изображению блюда
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Связь с категориями
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dishes');
    }
};

