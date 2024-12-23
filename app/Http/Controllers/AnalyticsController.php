<?php

namespace App\Http\Controllers;

use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
  protected AnalyticsService $analyticsService;

  public function __construct(AnalyticsService $analyticsService)
  {
    $this->analyticsService = $analyticsService;
  }

  public function sales(Request $request)
  {
    $this->authorize('view', 'reports');

    $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

    $salesAnalytics = $this->analyticsService->getFullSalesAnalytics($startDate, $endDate);

    return view('analytics.sales', compact('salesAnalytics', 'startDate', 'endDate'));
  }

  public function reservations(Request $request)
  {
    $this->authorize('view', 'reports');

    $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

    $fullAnalytics = $this->analyticsService->getFullReservationsAnalytics($startDate, $endDate);

    return view('analytics.reservations', compact('fullAnalytics', 'startDate', 'endDate'));
  }
}