<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception): Response
    {
        if ($exception instanceof AuthorizationException) {
            if ($request->expectsJson()) {
                // Для API-запросов
                return response()->json([
                    'success' => false,
                    'message' => 'Недостатньо прав доступу',
                ], 403);
            } else {
                // Для веб-запросов (Blade)
                return redirect()->back()
                    ->with('error', 'Недостатньо прав доступу');
            }
        }

        return parent::render($request, $exception);
    }
}
