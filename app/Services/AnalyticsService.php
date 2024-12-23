<?php

namespace App\Services;

use App\Repositories\AnalyticsRepository;
use Illuminate\Support\Collection;
use App\Repositories\BookingRepository;
use Carbon\Carbon;

class AnalyticsService
{
  protected AnalyticsRepository $analyticsRepository;
  protected BookingRepository $bookingRepository;

  public function __construct(AnalyticsRepository $analyticsRepository, BookingRepository $bookingRepository)
  {
    $this->analyticsRepository = $analyticsRepository;
    $this->bookingRepository = $bookingRepository;
  }

  /**
   * Получить топ-3 по сумме продаж.
   *
   * @param string $startDate Начало периода
   * @param string $endDate Конец периода
   * @return Collection
   */
  public function getTopByRevenue(string $startDate, string $endDate): Collection
  {
    return $this->analyticsRepository->getItems(3, 'total_price', $startDate, $endDate, 'top');
  }

  /**
   * Получить топ-3 по количеству продаж.
   *
   * @param string $startDate Начало периода
   * @param string $endDate Конец периода
   * @return Collection
   */
  public function getTopByQuantity(string $startDate, string $endDate): Collection
  {
    return $this->analyticsRepository->getItems(3, 'quantity', $startDate, $endDate, 'top');
  }

  /**
   * Получить 3 аутсайдера по сумме продаж.
   *
   * @param string $startDate Начало периода
   * @param string $endDate Конец периода
   * @return Collection
   */
  public function getOutsidersByRevenue(string $startDate, string $endDate): Collection
  {
    return $this->analyticsRepository->getItems(3, 'total_price', $startDate, $endDate, 'outsider');
  }

  /**
   * Получить 3 аутсайдера по количеству продаж.
   *
   * @param string $startDate Начало периода
   * @param string $endDate Конец периода
   * @return Collection
   */
  public function getOutsidersByQuantity(string $startDate, string $endDate): Collection
  {
    return $this->analyticsRepository->getItems(3, 'quantity', $startDate, $endDate, 'outsider');
  }

  // сумма всех продаж за период
  public function getTotalSales(string $startDate, string $endDate): float
  {
    return $this->analyticsRepository->getTotalSales($startDate, $endDate);
  }

  /**
   * Получить все данные аналитики за период.
   *
   * @param string $startDate Начало периода
   * @param string $endDate Конец периода
   * @return array
   */
  public function getFullSalesAnalytics(string $startDate, string $endDate): array
  {
    return [
      'topByRevenue' => $this->getTopByRevenue($startDate, $endDate),
      'topByQuantity' => $this->getTopByQuantity($startDate, $endDate),
      'outsidersByRevenue' => $this->getOutsidersByRevenue($startDate, $endDate),
      'outsidersByQuantity' => $this->getOutsidersByQuantity($startDate, $endDate),
      'totalSales' => $this->getTotalSales($startDate, $endDate),
    ];
  }

  public function reservationsByWeekday(string $startDate, string $endDate): array
  {
    $reservations = $this->bookingRepository->getReservationsByPeriod($startDate, $endDate);

    // Группируем бронирования по дням недели
    $groupedByWeekday = $reservations->groupBy(function ($reservation) {
      return Carbon::parse($reservation->reservation_date)->format('l'); // Преобразуем строку в Carbon
    });

    // Считаем общее количество бронирований за период
    $totalReservations = $reservations->count();

    // Подсчитываем количество бронирований по дням недели и их процент
    $result = $groupedByWeekday->map(function ($items, $weekday) use ($totalReservations) {
      $count = $items->count();
      $percentage = $totalReservations > 0 ? round(($count / $totalReservations) * 100, 2) : 0;

      return [
        'count' => $count,
        'percentage' => $percentage,
      ];
    });
    // Устанавливаем правильный порядок дней недели
    $weekdayOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    // Сортируем результат по порядку дней недели
    $sortedResult = collect($weekdayOrder)->mapWithKeys(function ($weekday) use ($result) {
      return [$weekday => $result->get($weekday, ['count' => 0, 'percentage' => 0])];
    });

    return $sortedResult->toArray();
  }

  public function reservationsByStartTime(string $startDate, string $endDate): array
  {
    $reservations = $this->bookingRepository->getReservationsByPeriod($startDate, $endDate);

    // Группируем бронирования по времени начала
    $groupedByStartTime = $reservations->groupBy(function ($reservation) {
      return Carbon::parse($reservation->start_time)->format('H:i'); // Преобразуем строку в Carbon и форматируем в HH:MM
    });

    // Считаем общее количество бронирований за период
    $totalReservations = $reservations->count();

    // Подсчитываем количество бронирований по времени начала и их процент
    $result = $groupedByStartTime->map(function ($items) use ($totalReservations) {
      $count = $items->count();
      $percentage = $totalReservations > 0 ? round(($count / $totalReservations) * 100, 2) : 0;

      return [
        'count' => $count,
        'percentage' => $percentage,
      ];
    });

    // Сортируем по времени (по ключам)
    return $result->sortKeys()->toArray();
  }

  public function getFullReservationsAnalytics(string $startDate, string $endDate): array
  {
    return [
      'byWeekday' => $this->reservationsByWeekday($startDate, $endDate),
      'byStartTime' => $this->reservationsByStartTime($startDate, $endDate),
    ];
  }
}
