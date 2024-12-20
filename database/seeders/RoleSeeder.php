<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Отключаем проверку внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if (Schema::hasTable('roles')) {
            // очищаем старую таблицу
            Role::truncate();
        }

        // заполняем таблицу
        foreach (RoleEnum::all() as $role) {
            Role::updateOrCreate(['name' => $role]);
        }

        // Включаем проверки внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
