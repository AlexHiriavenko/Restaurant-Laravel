<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade'); // Связь с разрешениями
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade'); // Связь с ролями
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
};
