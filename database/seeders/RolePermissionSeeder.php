<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        // Отключаем проверки внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Проверяем существование таблиц и очищаем их
        if (Schema::hasTable('role_permission')) {
            DB::table('role_permission')->truncate(); // Очищаем таблицу связывающую роли и разрешения
        }

        // Получаем роли
        $adminRole = Role::where('name', 'admin')->first();
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $managerRole = Role::where('name', 'manager')->first();

        // Получаем разрешения
        $allPermissions = Permission::all(); // Все разрешения
        $managerPermissions = Permission::whereIn('name', [
            'manage_all_orders',
            'manage_reservations',
        ])->get();

        // Привязываем разрешения к ролям
        $adminRole->permissions()->sync($allPermissions); // Админ получает все разрешения
        $superAdminRole->permissions()->sync($allPermissions); // Админ получает все разрешения
        $managerRole->permissions()->sync($managerPermissions); // Менеджер получает часть разрешений

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
