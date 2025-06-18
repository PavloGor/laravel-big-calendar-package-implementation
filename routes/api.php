<?php

use Illuminate\Support\Facades\Route;
use OpenHands\BigCalendar\Http\Controllers\CalendarEventController;
use OpenHands\BigCalendar\Http\Controllers\CalendarUserController;

Route::prefix('api/big-calendar')->group(function () {
    // Events routes
    Route::apiResource('events', CalendarEventController::class);
    Route::post('events/{id}/move', [CalendarEventController::class, 'move']);
    Route::post('events/{id}/resize', [CalendarEventController::class, 'resize']);

    // Users routes
    Route::apiResource('users', CalendarUserController::class)->only(['index', 'show']);
});
