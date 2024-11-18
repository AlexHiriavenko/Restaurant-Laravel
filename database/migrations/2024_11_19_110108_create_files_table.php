<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название файла
            $table->string('file_path'); // Путь к файлу
            $table->string('type'); // Тип файла (например, "image", "document")
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Пользователь, загрузивший файл (если применимо)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
