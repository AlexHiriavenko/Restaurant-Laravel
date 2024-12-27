<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use Carbon\Carbon;

class BookingRepository implements BookingRepositoryInterface
{

  public function allTables(): Collection
  {
    return Table::all();
  }

  public function getAllReservations(): Collection
  {
    return Reservation::all();
  }

  public function getReservationsByUserId(int $userId): Collection
  {
    return Reservation::where('user_id', $userId)->get();
  }

  public function createReservationForUser(int $userId, array $data): Reservation
  {
    $data['user_id'] = $userId;
    $reservation = Reservation::create($data);
    // return $reservation->load(['user', 'table']); // если надо подтянуть юзера и столик
    return $reservation;
  }

  public function getReservationsByTableIdWithDate(int $tableId, string $date): Collection
  {
    return Reservation::where('table_id', $tableId)
      ->where('reservation_date', $date)
      ->get();
  }

  public function getActiveReservationsByUserId(int $userId): Collection
  {
    return Reservation::where('user_id', $userId)
      ->where('reservation_date', '>=', now()->toDateString()) // Только сегодня и в будущем
      ->orderBy('reservation_date', 'asc')
      ->get();
  }

  public function getAllActiveReservations(): Collection
  {
    return Reservation::where('reservation_date', '>=', now()->toDateString()) // Только сегодня и в будущем
      ->orderBy('reservation_date', 'asc')
      ->get();
  }

  public function findReservationById(int $id): ?Reservation
  {
    return Reservation::find($id);
  }

  public function getReservationsByPeriod(string $startDate, string $endDate): Collection
  {
    return Reservation::whereBetween('reservation_date', [
      Carbon::parse($startDate)->toDateString(),
      Carbon::parse($endDate)->toDateString()
    ])->get();
  }

  public function getReservationsByTableIdAndDate(int $tableId, string $reservationDate): Collection
  {
    return Reservation::where('table_id', $tableId)
      ->where('reservation_date', $reservationDate)
      ->get();
  }
}
