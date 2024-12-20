<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
  public function run()
  {

    // Отключаем проверку внешних ключей
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Проверяем, существует ли таблица
    if (Schema::hasTable('reservations')) {
      // Очистка таблицы перед заполнением
      Reservation::truncate();
    }
    // Генерация 100 случайных бронирований
    Reservation::factory(300)->create();

    // Включаем проверки внешних ключей обратно
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
