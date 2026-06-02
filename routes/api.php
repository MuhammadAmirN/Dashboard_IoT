<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorController;

Route::post('/sensors', [SensorController::class, 'store']);