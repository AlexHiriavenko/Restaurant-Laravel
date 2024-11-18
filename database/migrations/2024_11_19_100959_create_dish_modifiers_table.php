<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// связывает блюда с модификаторами.

return new class extends Migration {
    public function up()
    {
        Schema::create('dish_modifiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dish_id')->constrained('dishes')->onDelete('cascade');
            $table->foreignId('modifier_id')->constrained('modifiers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dish_modifiers');
    }
};
