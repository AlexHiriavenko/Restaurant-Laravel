<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        foreach (RoleEnum::all() as $role) {
            Role::updateOrCreate(['name' => $role]);
        }
    }
}
