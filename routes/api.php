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

    Route::prefix('dishes')->group(function () {
        Route::post('/', [DishController::class, 'store'])->name('createDish');
        Route::put('{id}', [DishController::class, 'update'])->name('updateDish');
        Route::delete('{id}', [DishController::class, 'destroy'])->name('deleteDish');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/user/{id?}', [OrderController::class, 'getUserOrders'])->name('userOrders');
        Route::post('/store', [OrderController::class, 'store'])->name('store')->name('saveOrder');
    });

    Route::prefix('booking')->group(function () {
        Route::get('/tables', [BookingController::class, 'getTables'])->name('tables');
        Route::get('/index', [BookingController::class, 'index'])->name('reservations');
        Route::post('/store/user/{id?}', [BookingController::class, 'store'])->name('createReservation');
        Route::get('/active_reservations/user/{id?}', [BookingController::class, 'getUserActiveReservations'])->name('userActiveReservations');
        Route::delete('{id}', [BookingController::class, 'destroy'])->name('deleteReservation');
    });
});
