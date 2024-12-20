<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public function run()
    {
        // Отключаем проверку внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Проверяем, существует ли таблица
        if (Schema::hasTable('users')) {
            // Очистка таблицы перед заполнением
            User::truncate();
        }

        $superAdminRole = RoleEnum::find(RoleEnum::SuperAdmin->value);
        $adminRole = RoleEnum::find(RoleEnum::Admin->value);
        $managerRole = RoleEnum::find(RoleEnum::Manager->value);
        $clientRole = RoleEnum::find(RoleEnum::Client->value);

        User::create([
            'name' => 'super admin',
            'email' => 'superadmin@superadmin.com',
            'password' => Hash::make('superadmin'),
            'avatar' => 'imgs/avatars/admin.png',
            'role_id' => $superAdminRole->id,
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'avatar' => 'imgs/avatars/admin.png',
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => Hash::make('manager'),
            'avatar' => 'imgs/avatars/manager.png',
            'role_id' => $managerRole->id,
        ]);

        User::create([
            'name' => 'client',
            'email' => 'client@client.com',
            'password' => Hash::make('client'),
            'avatar' => 'imgs/avatars/client.png',
            'role_id' => $clientRole->id,
        ]);

        User::factory(100)->create([
            'password' => Hash::make('123456'), // Один пароль для всех
            'avatar' => null, // без аватара
            'role_id' => $clientRole->id, // у все Роль "Client"
        ]);

        // Включаем проверки внешних ключей обратно
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
