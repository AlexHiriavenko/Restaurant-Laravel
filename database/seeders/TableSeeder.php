<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    public function run()
    {
        // 4 столика по 2 места
        for ($i = 1; $i <= 4; $i++) {
            Table::create([
                'number' => $i,
                'capacity' => 2,
                'status' => 'available',
            ]);
        }

        // 4 столика по 4 места
        for ($i = 5; $i <= 8; $i++) {
            Table::create([
                'number' => $i,
                'capacity' => 4,
                'status' => 'available',
            ]);
        }

        // 2 столика по 6 мест
        for ($i = 9; $i <= 10; $i++) {
            Table::create([
                'number' => $i,
                'capacity' => 6,
                'status' => 'available',
            ]);
        }
    }
}
