<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Тип отчета (например, "продажи", "загруженность ресторана")
            $table->string('file_path'); // Путь к PDF-отчету
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Администратор, создавший отчет
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};

