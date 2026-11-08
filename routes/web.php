<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FanController;
use App\Models\Fan;

Route::get('/', fn () => view('landing'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware('auth')->get('/api/fans/{fan}/history', function (Fan $fan) {
    return $fan->histories()
        ->latest('recorded_at')
        ->limit(30)
        ->get()
        ->reverse()
        ->values()
        ->map(fn ($row) => [
            'temperature' => $row->temperature,
            'recorded_at' => $row->recorded_at?->format('H:i d/m'),
        ]);
});

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/history', [DashboardController::class, 'history'])->name('history');
    Route::resource('/fans', FanController::class)->except(['show'])->names('fans');
});
