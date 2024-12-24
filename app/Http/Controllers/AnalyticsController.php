<?php

namespace App\Http\Controllers;

use App\Services\AnalyticsService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

  public function downloadSalesAnalytics(Request $request)
  {
    $this->authorize('view', 'reports');

    $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->input('end_date', now()->endOfMonth()->toDateString());

    $salesAnalytics = $this->analyticsService->getFullSalesAnalytics($startDate, $endDate);

    // Генерация PDF с использованием нового шаблона
    $pdf = PDF::loadView('pdf.sales', compact('salesAnalytics', 'startDate', 'endDate'));

    // Скачивание PDF
    return $pdf->download('sales-analytics.pdf');
  }

  public function downloadReservationsAnalytics(Request $request)
  {
    $this->authorize('view', 'reports');

    $startDate = $request->query('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->query('end_date', now()->endOfMonth()->toDateString());

    $fullAnalytics = $this->analyticsService->getFullReservationsAnalytics($startDate, $endDate);

    $pdf = PDF::loadView('pdf.reservations', compact('fullAnalytics', 'startDate', 'endDate'));

    return $pdf->download('reservations-analytics.pdf');
  }

  public function sendMailWithPdfAttachment(Request $request)
  {
    $this->authorize('view', 'reports');

    $startDate = $request->query('start_date', now()->startOfMonth()->toDateString());
    $endDate = $request->query('end_date', now()->endOfMonth()->toDateString());
    $email = $request->input('email', 'martmarchmartmarch@gmail.com');

    $this->analyticsService->sendMailWithPdfAttachment($startDate, $endDate, $email);

    return redirect()->route('analytics.sales', [
      'start_date' => $startDate,
      'end_date' => $endDate,
    ])->with('success', 'status: successfully.');
  }
}
