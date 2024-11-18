<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modifier;

class ModifierSeeder extends Seeder
{
    public function run()
    {
        // Создаём модификаторы через модель Modifier
        Modifier::create(['name' => 'Соль']);
        Modifier::create(['name' => 'Перец']);
        Modifier::create(['name' => 'Хлеб']);
        Modifier::create(['name' => 'Сахар']);
        Modifier::create(['name' => 'Лимон']);
        Modifier::create(['name' => 'Мёд']);
        Modifier::create(['name' => 'Шоколадная крошка']);
        Modifier::create(['name' => 'Сгущённое молоко']);
    }
}
