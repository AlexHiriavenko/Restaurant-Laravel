<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_item_modifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade'); // Связь с позицией заказа
            $table->foreignId('modifier_id')->constrained('modifiers')->onDelete('cascade'); // Связь с модификатором
            $table->string('name'); // Название модификатора
            $table->decimal('price', 10, 2); // Цена модификатора
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item_modifiers');
    }
};
