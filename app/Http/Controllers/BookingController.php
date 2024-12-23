<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Http\Requests\BookingStoreRequest;
use App\Http\Resources\TableResource;
use App\Http\Resources\ReservationResource;
use App\Services\Interfaces\BookingServiceInterface;


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
        // проверка прав доступа через Policy
        $this->authorize('viewAny', Reservation::class);

        $reservations = $this->bookingService->getAllReservations();
        return ReservationResource::collection($reservations)->resolve();
    }

    public function getAllActiveReservations(): JsonResponse|array
    {
        // проверка прав доступа через Policy
        $this->authorize('viewAny', Reservation::class);

        $reservations = $this->bookingService->getAllActiveReservations();
        return ReservationResource::collection($reservations)->resolve();
    }

    public function getUserReservations(?int $id = null): JsonResponse|array
    {
        $userId = $id ?? Auth::id();

        // проверка прав доступа через Policy
        $this->authorize('view', [Reservation::class, $userId]);

        $reservations = $this->bookingService->getReservationsByUserId($userId);

        return ReservationResource::collection($reservations)->resolve();
    }

    public function getUserActiveReservations(?int $id = null): JsonResponse|array
    {
        $userId = $id ?? Auth::id();

        // Проверка прав доступа через Policy
        $this->authorize('view', [Reservation::class, $userId]);

        // Получение актуальных бронирований юзера (>= сегодня)
        $reservations = $this->bookingService->getActiveReservationsByUserId($userId);
        return ReservationResource::collection($reservations)->resolve();
    }

    public function store(BookingStoreRequest $request): ReservationResource
    {
        $userId = $request->defineUserId();

        $reservation = $this->bookingService->createReservation($userId, $request->validated());

        return new ReservationResource($reservation);
    }

    public function destroy(int $id): JsonResponse
    {
        // Найти бронирование через сервис
        $reservation = $this->bookingService->findReservationById($id);

        if (!$reservation) {
            return response()->json(['message' => 'Бронирование не найдено.'], 404);
        }

        // Проверка прав доступа через Policy
        $this->authorize('delete', $reservation);

        // Выполнение удаления через сервис
        $deleted = $this->bookingService->deleteReservation($reservation);

        if ($deleted) {
            return response()->json(['message' => 'Бронирование успешно удалено.']);
        }

        return response()->json(['message' => 'Не удалось удалить бронирование.'], 500);
    }
}
