<?php

use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/processed', [DashboardController::class, 'processed'])->name('dashboard.processed');
Route::get('/export/txt', [DashboardController::class, 'exportTxt'])->name('export.txt');
