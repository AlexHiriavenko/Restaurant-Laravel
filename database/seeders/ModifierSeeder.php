<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modifier;

class ModifierSeeder extends Seeder
{
    public function run()
    {
        // Создаём модификаторы через модель Modifier с ценами
        Modifier::create(['name' => 'Соль', 'price' => 0]);
        Modifier::create(['name' => 'Перец', 'price' => 0]);
        Modifier::create(['name' => 'Хлеб', 'price' => 6]);
        Modifier::create(['name' => 'Сахар', 'price' => 0]);
        Modifier::create(['name' => 'Лимон', 'price' => 4]);
        Modifier::create(['name' => 'Мёд', 'price' => 10]);
        Modifier::create(['name' => 'Шоколадная крошка', 'price' => 6]);
        Modifier::create(['name' => 'Сгущённое молоко', 'price' => 8]);
    }
}
