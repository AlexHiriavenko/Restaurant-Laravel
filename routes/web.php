<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\AnalyticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard',  fn() => view('dashboard'))->name('dashboard');

    Route::prefix('/users')->group(function () {
        Route::get('/', fn() => view('users.manage-users'))->name('users');
        Route::get('/update-role', [UserController::class, 'showUpdateRolePage'])->name('users.update-role');
        Route::patch('/update-role', [UserController::class, 'updateRole'])->name('users.update-role.post');
    });

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/search', [OrderController::class, 'searchOrders'])->name('orders.search');
        Route::patch('/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::get('/orders',  fn() => view('orders.orders'))->name('orders');
    });

    Route::prefix('/dishes')->group(function () {
        Route::get('/search', [DishController::class, 'index'])->name('dishes.search');
        Route::get('{id}', [DishController::class, 'show'])->name('dishes.show')->where('id', '[0-9]+');
        Route::post('{id}', [DishController::class, 'update'])->name('dishes.update')->where('id', '[0-9]+');
    });

    Route::get('/analytics', fn() => view('analytics.index'))->name('analytics');
    Route::get('/analytics/sales', [AnalyticsController::class, 'sales'])->name('analytics.sales');
    Route::get('/analytics/reservations', [AnalyticsController::class, 'reservations'])->name('analytics.reservations');
});
