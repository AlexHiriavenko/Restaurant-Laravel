<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Services\Interfaces\BookingServiceInterface;

class BookingService implements BookingServiceInterface
{
  protected BookingRepositoryInterface $bookingRepository;

  public function __construct(BookingRepositoryInterface $bookingRepository)
  {
    $this->bookingRepository = $bookingRepository;
  }

  public function getTables(): Collection
  {
    return $this->bookingRepository->allTables();
  }

  public function getAllReservations(): Collection
  {
    return $this->bookingRepository->getAllReservations();
  }

  public function getReservationsByUserId(int $userId): Collection
  {
    return $this->bookingRepository->getReservationsByUserId($userId);
  }

  public function createReservation(int $userId, array $data): mixed
  {
    return $this->bookingRepository->createReservationForUser($userId, $data);
  }

  public function getReservationsByTableIdWithDate(int $tableId, string $date): Collection
  {
    return $this->bookingRepository->getReservationsByTableIdWithDate($tableId, $date);
  }

  public function getActiveReservationsByUserId(int $userId): Collection
  {
    return $this->bookingRepository->getActiveReservationsByUserId($userId);
  }

  public function getAllActiveReservations(): Collection
  {
    return $this->bookingRepository->getAllActiveReservations();
  }
}
