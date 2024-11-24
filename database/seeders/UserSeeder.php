<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $clientRole = Role::where('name', 'client')->first();

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'avatar' => 'imgs/avatars/admin.jpg',
            'role_id' => $adminRole->id, // Привязка к роли
        ]);

        User::create([
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => Hash::make('manager'),
            'avatar' => 'imgs/avatars/manager.jpg',
            'role_id' => $managerRole->id, // Привязка к роли
        ]);

        User::create([
            'name' => 'client',
            'email' => 'client@client.com',
            'password' => Hash::make('client'),
            'avatar' => 'imgs/avatars/client.jpg',
            'role_id' => $clientRole->id, // Привязка к роли
        ]);
    }
}
