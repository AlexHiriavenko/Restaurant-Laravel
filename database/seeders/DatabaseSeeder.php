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
            RoleSeeder::class,                  // Сначала создаются роли
            PermissionSeeder::class,            // Затем создаются разрешения
            RolePermissionSeeder::class,        // Привязываются роли и разрешения
            UserSeeder::class,                  // Затем создаются пользователи с ролями
            CategorySeeder::class,              // После этого создаются категории
            ModifierSeeder::class,              // Затем модификаторы
            TableSeeder::class,                 // Потом столики
            DishSeeder::class,                  // Дальше блюда
            DishModifierSeeder::class,          // Связь блюд с модификаторами
            ReservationSeeder::class,           // Заполнить фейковые бронирования
            OrderSeeder::class,                 // Заполнить фейковые заказы блюд
            OrderItemSeeder::class,                 // Привязать блюда к заказам 
            OrderItemModifierSeeder::class,     // Привязать модификторы к блюдам
            CalculateTotalPriceSeeder::class,   // Расчитасть стоимость блюда с модификаторами _И_ общую стоиость заказа
        ]);
    }
}
