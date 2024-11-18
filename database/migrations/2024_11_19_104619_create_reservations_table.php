<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Пользователь
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade'); // Столик
            $table->integer('guest_count'); // Количество гостей
            $table->dateTime('reservation_time'); // Время начала бронирования
            $table->integer('duration')->default(1); // Продолжительность бронирования в часах
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // Статус
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};

