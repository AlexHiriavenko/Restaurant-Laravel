<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Reservation;

interface BookingRepositoryInterface
{
  public function allTables(): Collection;

  public function getAllReservations(): Collection;

  public function getReservationsByUserId(int $userId): Collection;

  public function createReservationForUser(int $userId, array $data): mixed;

  public function getReservationsByTableIdWithDate(int $tableId, string $date): Collection;

  public function getActiveReservationsByUserId(int $userId): Collection;

  public function getAllActiveReservations(): Collection;

  public function findReservationById(int $id): ?Reservation;

  public function getReservationsByPeriod(string $startDate, string $endDate): Collection;

  public function getReservationsByTableIdAndDate(int $tableId, string $reservationDate): Collection;
}
