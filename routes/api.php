<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route::options('/{any}', function (Request $request) {
//     return response('', 200)
//         ->header('Access-Control-Allow-Origin', $request->headers->get('Origin'))
//         ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//         ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
//         ->header('Access-Control-Allow-Credentials', 'true');
// })->where('any', '.*');

// Эндпоинт для получения текущего пользователя
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Маршруты, не требующие авторизации
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{id}/dishes', [DishController::class, 'getByCategory']);
});

Route::prefix('dishes')->group(function () {
    Route::get('/', [DishController::class, 'index']);
    Route::get('promo', [DishController::class, 'getByDiscount']);
    Route::get('{id}', [DishController::class, 'show'])->where('id', '[0-9]+');
    Route::get('{slug}', [DishController::class, 'findBySlug'])->where('slug', '[a-zA-Z_-]+');
});


// Маршруты, требующие авторизации
Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'getUser']);
    });

    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('{id}', [CategoryController::class, 'update']);
        Route::delete('{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('dishes')->group(function () {
        Route::post('/', [DishController::class, 'store'])->name('createDish');
        Route::put('{id}', [DishController::class, 'update'])->name('updateDish');
        Route::delete('{id}', [DishController::class, 'destroy'])->name('deleteDish');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/user-history/{id?}', [OrderController::class, 'getUserOrders'])->name('userOrdersHistory');
        Route::post('/store', [OrderController::class, 'store'])->name('store')->name('saveOrder');
    });

    Route::prefix('booking')->group(function () {
        Route::get('/tables', [BookingController::class, 'getTables'])->name('tables');
        Route::get('/reservations', [BookingController::class, 'getAllReservations'])->name('getAllReservations');
        Route::get('/reservations/user/{id}', [BookingController::class, 'getReservationsByUserId'])->name('getReservationsByUser');
        Route::post('/store', [BookingController::class, 'store'])->name('createReservation');
    });
});
