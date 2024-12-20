<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
  protected $model = Reservation::class;

  public function definition(): array
  {
    // Получаем количество пользователей и столиков из базы данных
    $userCount = User::count();
    $tableCount = Table::count();

    // Генерация рандомной даты бронирования
    $reservationDate = fake()->dateTimeBetween('now', '+1 months')->format('Y-m-d');

    // Генерация времени начала и конца бронирования
    $startHour = fake()->numberBetween(9, 19); // Часы от 9 до 19
    $startMinute = fake()->randomElement([0, 30]); // Минуты с шагом 30
    $startTime = sprintf('%02d:%02d', $startHour, $startMinute);

    // Рандомное добавление 2, 4 или 6 часов
    $duration = fake()->randomElement([2, 4, 6]);
    $endTime = Carbon::createFromTimeString($startTime)->addHours($duration)->format('H:i');

    return [
      'user_id' => fake()->numberBetween(1, $userCount),
      'table_id' => fake()->numberBetween(1, $tableCount),
      'reservation_date' => $reservationDate,
      'start_time' => $startTime,
      'end_time' => $endTime,
      'phone_number' => fake()->numerify('##########'), // Генерация номера из 10 цифр
      'name' => function (array $attributes) {
        return User::find($attributes['user_id'])->name ?? fake()->name();
      },
    ];
  }
}
