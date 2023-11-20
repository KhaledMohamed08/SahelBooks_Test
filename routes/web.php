<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

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

// routes
Route::prefix('order')->group( function () {
    Route::get('index', [OrderController::class, 'index'])->name('index');
    Route::get('count', [OrderController::class, 'calculateOrder'])->name('count');
});
