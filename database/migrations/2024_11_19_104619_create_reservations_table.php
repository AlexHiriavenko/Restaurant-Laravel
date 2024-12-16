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
            $table->date('reservation_date'); // Дата бронирования
            $table->time('start_time'); // Время начала бронирования
            $table->time('end_time'); // Время конца бронирования
            $table->string('phone_number'); // Номер телефона клиента
            $table->string('name'); // Имя клиента
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
