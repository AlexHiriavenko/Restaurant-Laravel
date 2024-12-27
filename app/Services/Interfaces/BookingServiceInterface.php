<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Reservation;

interface BookingServiceInterface
{

  public function getTables(): Collection;

  public function getAllReservations(): Collection;

  public function getReservationsByUserId(int $userId): Collection;

  public function createReservation(int $userId, array $data): mixed;

  public function getReservationsByTableIdWithDate(int $tableId, string $date): Collection;

  public function getActiveReservationsByUserId(int $userId): Collection;

  public function getAllActiveReservations(): Collection;

  public function findReservationById(int $id): ?Reservation;

  public function deleteReservation(Reservation $reservation): bool;

  public function getReservationsByTableAndDate(int $tableId, string $reservationDate): Collection;
}
