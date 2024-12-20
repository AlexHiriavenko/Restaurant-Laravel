<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Отключаем проверки внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Проверяем, существует ли таблица
        if (Schema::hasTable('permissions')) {
            // Очистка таблицы перед заполнением
            Permission::truncate();
        }

        // Включаем проверки внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Добавляем записи в таблицу
        Permission::create(['name' => 'manage_all_orders']);
        Permission::create(['name' => 'manage_reservations']);
        Permission::create(['name' => 'manage_dishes']);
        Permission::create(['name' => 'view_reports']);
        Permission::create(['name' => 'manage_users']);

        // Включаем проверки внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
