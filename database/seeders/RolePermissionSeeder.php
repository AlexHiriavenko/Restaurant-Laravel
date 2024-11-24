<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Получаем роли
        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();

        // Получаем разрешения
        $allPermissions = Permission::all(); // Все разрешения
        $managerPermissions = Permission::whereIn('name', [
            'manage_all_orders',
            'manage_reservations',
        ])->get();

        // Привязываем разрешения к ролям
        $adminRole->permissions()->sync($allPermissions); // Админ получает все разрешения
        $managerRole->permissions()->sync($managerPermissions); // Менеджер получает часть разрешений
    }
}
