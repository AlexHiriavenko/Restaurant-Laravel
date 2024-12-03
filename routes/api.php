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

// http://localhost:8080/api/categories
Route::get('categories', [CategoryController::class, 'index']);

// http://localhost:8080/api/categories/3/dishes
Route::get('categories/{id}/dishes', [DishController::class, 'getByCategory']);

// http://localhost:8080/api/dishes?search=морква&per_page=4
Route::get('dishes', [DishController::class, 'index']);

// http://localhost:8080/api/dishes/promo
Route::get('dishes/promo', [DishController::class, 'getByDiscount']);

// http://localhost:8080/api/dishes/9
Route::get('dishes/{id}', [DishController::class, 'show'])->where('id', '[0-9]+');

// http://localhost:8080/api/dishes/chaj
Route::get('dishes/{slug}', [DishController::class, 'findBySlug'])->where('slug', '[a-zA-Z_-]+');
