<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,            // Сначала создаются роли
            PermissionSeeder::class,      // Затем создаются разрешения
            RolePermissionSeeder::class,  // Привязываются роли и разрешения
            UserSeeder::class,            // Затем создаются пользователи с ролями
            CategorySeeder::class,        // После этого создаются категории
            ModifierSeeder::class,        // Затем модификаторы
            TableSeeder::class,           // Потом столики
            DishSeeder::class,            // Дальше блюда
            DishModifierSeeder::class,    // Связь блюд с модификаторами
        ]);
    }
}
