<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi untuk Midtrans Payment Gateway
    | Dapatkan Server Key dan Client Key dari https://dashboard.midtrans.com
    |
    */

    // Set to true for production, false for sandbox/development
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    // Midtrans Server Key (untuk backend/SNAP)
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),

    // Midtrans Client Key (untuk frontend)
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),

    // Merchant ID (opsional, tergantung metode pembayaran)
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', ''),

    // Konfigurasi Snap (jika menggunakan Snap)
    'snap' => [
        'is_midtrans' => true,
        'is Production' => env('MIDTRANS_IS_PRODUCTION', false),
        'server_key' => env('MIDTRANS_SERVER_KEY', ''),
        'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    ],

    // Konfigurasi URL untuk callback/notification
    'urls' => [
        'base_url' => env('MIDTRANS_BASE_URL', 'https://api.midtrans.com'),
        'finish_url' => env('APP_URL') . '/payment/finish',
        'unfinish_url' => env('APP_URL') . '/payment/unfinish',
        'error_url' => env('APP_URL') . '/payment/error',
    ],

    // Enable log untuk debugging
    'enable_log' => env('MIDTRANS_ENABLE_LOG', true),
];
