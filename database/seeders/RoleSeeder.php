<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\RoleEnum;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Отключаем проверку внешних ключей
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        foreach (RoleEnum::all() as $role) {
            Role::updateOrCreate(['name' => $role]);
        }
    }
}
