<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/history', [DashboardController::class, 'history'])->name('history');
Route::get('/history/export-pdf', [DashboardController::class, 'exportPdf'])->name('history.export');

// Rute untuk fitur Baca Data (Komparasi)
Route::get('/baca-data', [DashboardController::class, 'bacaData'])->name('baca-data');
Route::get('/api/baca-data/{session_id}', [DashboardController::class, 'getSensorLogs'])->name('api.baca-data');