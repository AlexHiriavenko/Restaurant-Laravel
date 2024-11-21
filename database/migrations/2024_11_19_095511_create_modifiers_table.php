<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('modifiers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название модификатора
            $table->decimal('price', 5, 2); // Цена
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modifiers');
    }
};

