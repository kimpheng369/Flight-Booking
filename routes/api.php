<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FlightController;
use Illuminate\Support\Facades\Route;

// Public API endpoints
Route::get('/airports', [\App\Http\Controllers\Api\AirportController::class, 'index']);
Route::get('/flights', [FlightController::class, 'index']);
Route::get('/flights/{flight}', [FlightController::class, 'show']);

// Authenticated API endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{booking}', [BookingController::class, 'show']);
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);
});

// Fallback open booking endpoints for testing without token
Route::get('/guest/bookings', [BookingController::class, 'index']);
Route::post('/guest/bookings', [BookingController::class, 'store']);
