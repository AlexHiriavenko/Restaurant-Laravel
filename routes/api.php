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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', [CategoryController::class, 'index']);

Route::get('categories/{id}/dishes', [DishController::class, 'getByCategory']);

Route::get('dishes', [DishController::class, 'index']);

Route::get('dishes/promo', [DishController::class, 'getByDiscount']);

Route::get('dishes/{id}', [DishController::class, 'show'])->where('id', '[0-9]+');

Route::get('dishes/{slug}', [DishController::class, 'getBySlug'])->where('slug', '[a-zA-Z_-]+');
