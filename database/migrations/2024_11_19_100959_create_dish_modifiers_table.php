<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dish_modifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dish_id')->constrained('dishes')->onDelete('cascade'); // Связь с блюдами
            $table->foreignId('modifier_id')->constrained('modifiers')->onDelete('cascade'); // Связь с модификаторами
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dish_modifiers');
    }
};
