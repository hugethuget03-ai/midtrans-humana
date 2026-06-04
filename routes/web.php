<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Disini adalah routes untuk website kosong perusahaan Humana
| dengan Payment Gateway Midtrans
|
*/

// Diagnostic route for Vercel environment checks
Route::get('/debug-raw', function () {
    return new \Illuminate\Http\Response('OK', 200);
});

// Landing page - website kosong
Route::get('/', function () {
    return view('welcome');
});

// Payment Gateway Routes
Route::prefix('payment')->group(function () {

    // Halaman utama payment
    Route::get('/', [PaymentController::class, 'index'])->name('payment.index');

    // Create transaction (get snap token)
    Route::post('/create', [PaymentController::class, 'createTransaction'])->name('payment.create');

    // Checkout endpoint
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');

    // Midtrans callback/notification webhook
    // IMPORTANT: Matikan CSRF protection untuk webhook ini di VerifyCsrfToken middleware
    Route::post('/callback', [PaymentController::class, 'callback'])->name('payment.callback');

    // Finish URL - setelah customer selesai di Midtrans
    Route::get('/finish', [PaymentController::class, 'finish'])->name('payment.finish');

    // Unfinish URL - jika customer tidak selesaikan payment
    Route::get('/unfinish', [PaymentController::class, 'unfinish'])->name('payment.unfinish');

    // Error URL - jika terjadi error
    Route::get('/error', [PaymentController::class, 'error'])->name('payment.error');

    // Check transaction status
    Route::get('/status/{orderId}', [PaymentController::class, 'checkStatus'])->name('payment.status');
});

// Health check endpoint untuk verifikasi server
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'Humana Payment Gateway',
        'midtrans_configured' => !empty(config('midtrans.server_key')),
        'timestamp' => now()->toIso8601String(),
    ]);
});