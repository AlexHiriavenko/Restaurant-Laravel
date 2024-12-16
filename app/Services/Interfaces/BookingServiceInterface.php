<?php

declare(strict_types=1);

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface BookingServiceInterface
{

  public function getTables(): Collection;

  public function getAllReservations(): Collection;

  public function getReservationsByUserId(int $userId): Collection;

  public function createReservation(int $userId, array $data): mixed;

  public function getReservationsByTableIdWithDate(int $tableId, string $date): Collection;

  public function getActiveReservationsByUserId(int $userId): Collection;

  public function getAllActiveReservations(): Collection;
}
