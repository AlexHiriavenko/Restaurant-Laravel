<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modifier;

class ModifierSeeder extends Seeder
{
    public function run()
    {
        // Создаём модификаторы через модель Modifier с ценами
        Modifier::create(['name' => 'Сіль', 'price' => 0]);
        Modifier::create(['name' => 'Перець', 'price' => 0]);
        Modifier::create(['name' => 'Хліб', 'price' => 6]);
        Modifier::create(['name' => 'Цукор', 'price' => 0]);
        Modifier::create(['name' => 'Лимон', 'price' => 4]);
        Modifier::create(['name' => 'Мед', 'price' => 10]);
        Modifier::create(['name' => 'Шоколадна крихта', 'price' => 6]);
        Modifier::create(['name' => 'Згушене молоко', 'price' => 8]);
        Modifier::create(['name' => 'Зелень', 'price' => 10]);
        Modifier::create(['name' => 'Сухарики', 'price' => 8]);
        Modifier::create(['name' => 'Часниковий соус', 'price' => 10]);
    }
}
