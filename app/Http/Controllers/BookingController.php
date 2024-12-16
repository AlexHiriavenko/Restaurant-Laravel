<?php

namespace App\Http\Controllers;

use App\Http\Resources\TableResource;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\BookingServiceInterface;
use Illuminate\Http\Request;

class BookingController extends Controller
{
  protected $bookingService;

  public function __construct(BookingServiceInterface $bookingService)
  {
    $this->bookingService = $bookingService;
  }

  public function getTables()
  {
    $tables = $this->bookingService->getTables();
    return TableResource::collection($tables)->resolve();
  }

  public function getAllReservations()
  {
    $reservations = $this->bookingService->getAllReservations();
    return ReservationResource::collection($reservations)->resolve();
  }

  public function getReservationsByUserId(int $userId)
  {
    $reservations = $this->bookingService->getReservationsByUserId($userId);
    return ReservationResource::collection($reservations)->resolve();
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'table_id' => 'required|integer|exists:tables,id',
      'reservation_date' => 'required|date',
      'start_time' => 'required|date_format:H:i',
      'end_time' => 'required|date_format:H:i|after:start_time',
      'phone_number' => 'required|string|max:15',
      'name' => 'required|string|max:255',
    ]);

    $reservation = $this->bookingService->createReservation(auth()->id(), $data);
    return new ReservationResource($reservation);
  }

  public function getActiveReservationsByUser()
  {
    $reservations = $this->bookingService->getActiveReservationsByUserId(auth()->id());
    return ReservationResource::collection($reservations)->resolve();
  }

  public function getAllActiveReservations()
  {
    $reservations = $this->bookingService->getAllActiveReservations();
    return ReservationResource::collection($reservations)->resolve();
  }
}
