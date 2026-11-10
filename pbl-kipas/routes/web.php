<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FanController;
use App\Http\Controllers\FanHistoryController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/fans', [FanController::class, 'index'])
    ->name('fans.index');

Route::post('/fans', [FanController::class, 'store'])
    ->name('fans.store');

Route::get('/fans/create', [FanController::class, 'create'])
    ->name('fans.create');

Route::get('/fans/{fan}/edit', [FanController::class, 'edit'])
    ->name('fans.edit');

Route::put('/fans/{fan}', [FanController::class, 'update'])
    ->name('fans.update');

Route::delete('/fans/{fan}', [FanController::class, 'destroy'])
    ->name('fans.destroy');

Route::get('/fans/{fan}', [FanController::class, 'show'])
    ->name('fans.show');

Route::get('/histories', [FanHistoryController::class, 'index'])
    ->name('histories.index');