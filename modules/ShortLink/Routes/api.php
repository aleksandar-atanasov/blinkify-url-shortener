<?php

/**
 * Example API Routes
 */

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->name('api.')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/test', fn() => 'Hello')->name('test');
});
