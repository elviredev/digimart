<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

// Homepage Frontend
Route::get('/', [HomeController::class, 'index'])
  ->name('home');


Route::group(['middleware' => ['auth', 'verified']], function () {
  // Dashboard Frontend
  Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
});

require __DIR__.'/auth.php';
