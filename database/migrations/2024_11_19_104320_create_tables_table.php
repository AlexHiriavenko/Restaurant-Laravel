<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique(); // Номер столика
            $table->integer('capacity'); // Вместимость (2, 4, 6 человек)
            $table->enum('status', ['available', 'occupied'])->default('available'); // Статус столика
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tables');
    }
};

