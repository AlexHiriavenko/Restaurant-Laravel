<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['name' => 'manage_all_orders']);
        Permission::create(['name' => 'manage_reservations']);
        Permission::create(['name' => 'manage_dishes']);
        Permission::create(['name' => 'view_reports']);
    }
}
