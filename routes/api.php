<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Routes untuk API endpoints
|
*/

// Payment API endpoints
Route::prefix('payment')->group(function () {
    // Check transaction status
    Route::get('/status/{orderId}', [PaymentController::class, 'checkStatus']);
});