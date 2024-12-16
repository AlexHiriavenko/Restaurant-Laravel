<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Resources\TableResource;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\BookingServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function getTables(): JsonResponse|array
    {
        $tables = $this->bookingService->getTables();
        return TableResource::collection($tables)->resolve();
    }

    public function index(): JsonResponse|array
    {
        $reservations = $this->bookingService->getAllReservations();
        return ReservationResource::collection($reservations)->resolve();
    }

    public function getReservationsByUserId(int $userId): JsonResponse|array
    {
        $reservations = $this->bookingService->getReservationsByUserId($userId);
        return ReservationResource::collection($reservations)->resolve();
    }

    public function store(BookingStoreRequest $request): ReservationResource
    {
        $userId = $request->defineUserId();
        $reservation = $this->bookingService->createReservation($userId, $request->validated());
        return new ReservationResource($reservation);
    }

    public function getActiveReservationsByUser(): JsonResponse|array
    {
        $reservations = $this->bookingService->getActiveReservationsByUserId(auth()->id());
        return ReservationResource::collection($reservations)->resolve();
    }

    public function getAllActiveReservations(): JsonResponse|array
    {
        $reservations = $this->bookingService->getAllActiveReservations();
        return ReservationResource::collection($reservations)->resolve();
    }
}
