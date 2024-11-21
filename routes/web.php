<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Dish;

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

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/users', [UserController::class, 'index']);

Route::get('/dishes', function () {
    $dishes = Dish::with(['category', 'modifiers'])->get();

    foreach ($dishes as $dish) {
        echo "- {$dish->name}: {$dish->category->name}<br>";
        foreach ($dish->modifiers as $modifier) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;- {$modifier->name}<br>";
        }
        echo "<br>";
    }
});
