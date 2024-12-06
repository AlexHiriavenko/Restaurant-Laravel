<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Эндпоинт для получения текущего пользователя
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

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
    Route::prefix('categories')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('{id}', [CategoryController::class, 'update']);
        Route::delete('{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('dishes')->group(function () {
        Route::post('/', [DishController::class, 'store']);
        Route::put('{id}', [DishController::class, 'update']);
        Route::delete('{id}', [DishController::class, 'destroy']);
    });
});
