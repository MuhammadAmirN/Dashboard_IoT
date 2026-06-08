<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Guru Routes
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':guru'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/history', [DashboardController::class, 'history'])->name('history');
    Route::get('/history/export-pdf', [DashboardController::class, 'exportPdf'])->name('history.export');
    Route::get('/baca-data', [DashboardController::class, 'bacaData'])->name('baca-data');
    Route::get('/api/baca-data/{session_id}', [DashboardController::class, 'getSensorLogs'])->name('api.baca-data');
});

// Murid Routes
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class.':murid'])->group(function () {
    Route::get('/murid/dashboard', [\App\Http\Controllers\MuridController::class, 'index'])->name('murid.dashboard');
});

// Auth Routes
require __DIR__.'/auth.php';
