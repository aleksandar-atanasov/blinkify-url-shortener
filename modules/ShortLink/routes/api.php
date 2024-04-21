<?php


use Illuminate\Support\Facades\Route;
use Modules\ShortLink\Http\Controllers\Api\CreateShortLinkController;
use Modules\ShortLink\Http\Controllers\Api\RedirectToOriginalUrlController;

Route::middleware(['auth:sanctum'])->prefix('api/v1')->name('api.')->group(function () {
    Route::post('/link/create', CreateShortLinkController::class)->name('link.store');
    Route::get('/link/redirect/{shortUrl}', RedirectToOriginalUrlController::class)
         ->name('link.redirect')
         ->where('shortUrl', '[0-9a-zA-Z]{7}');
});
