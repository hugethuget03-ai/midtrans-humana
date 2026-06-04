<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\CoreApi;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Initialize Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Set Base URL untuk Core API
        Config::$apiBaseUrl = config('midtrans.urls.base_url', 'https://api.midtrans.com');
    }

    /**
     * Menampilkan halaman pembayaran
     */
    public function index()
    {
        return view('payment.index');
    }

    /**
     * Membuat transaksi baru dan mendapatkan SNAP token
     */
    public function createTransaction(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'amount' => 'required|numeric|min:10000',
                'customer_name' => 'required|string|max:100',
                'customer_email' => 'required|email|max:100',
                'customer_phone' => 'required|string|max:20',
                'description' => 'nullable|string|max:255',
            ]);

            // Generate unique order_id
            $orderId = 'ORD-' . time() . '-' . rand(1000, 9999);

            // Simpan transaksi awal ke database
            Transaction::create([
                'order_id' => $orderId,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'gross_amount' => (int) $request->amount,
                'transaction_status' => 'pending',
                'description' => $request->description,
            ]);

            // Prepare transaction parameters
            $transactionParams = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $request->amount,
                ],
                'customer_details' => [
                    'first_name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'phone' => $request->customer_phone,
                ],
                'item_details' => [
                    [
                        'id' => 'item-1',
                        'price' => (int) $request->amount,
                        'quantity' => 1,
                        'name' => $request->description ?? 'Pembayaran',
                    ],
                ],
                'callbacks' => [
                    'finish' => config('midtrans.urls.finish_url'),
                    'unfinish' => config('midtrans.urls.unfinish_url'),
                    'error' => config('midtrans.urls.error_url'),
                ],
                'credit_card' => [
                    'secure' => true,
                ],
            ];

            // Get SNAP token
            $snapToken = Snap::getSnapToken($transactionParams);

            // Log untuk debugging
            Log::info('SNAP Token Generated', [
                'order_id' => $orderId,
                'amount' => $request->amount,
            ]);

            return response()->json([
                'success' => true,
                'token' => $snapToken,
                'order_id' => $orderId,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Checkout - proses pembayaran
     */
    public function checkout(Request $request)
    {
        return $this->createTransaction($request);
    }

    /**
     * Handle callback/notification dari Midtrans (Webhook)
     * PENTING: Nonaktifkan CSRF protection untuk route ini
     */
    public function callback(Request $request)
    {
        try {
            // Log raw notification untuk debugging
            Log::info('Midtrans Callback Received', $request->all());

            // Initialize notification
            $notification = new Notification();

            // Get transaction status
            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;
            $statusCode = $notification->status_code;
            $paymentType = $notification->payment_type;
            $grossAmount = $notification->gross_amount;
            $transactionId = $notification->transaction_id ?? null;
            $fraudStatus = $notification->fraud_status ?? null;

            Log::info('Transaction Notification', [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'status_code' => $statusCode,
                'payment_type' => $paymentType,
                'gross_amount' => $grossAmount,
                'fraud_status' => $fraudStatus,
            ]);

            // Cari transaksi di database
            $transaction = Transaction::where('order_id', $orderId)->first();

            if ($transaction) {
                // Update transaksi
                $updateData = [
                    'payment_type' => $paymentType,
                    'transaction_status' => $transactionStatus,
                    'status_code' => $statusCode,
                    'transaction_id' => $transactionId,
                    'fraud_status' => $fraudStatus,
                    'payload' => $request->all(),
                ];

                // Set settlement time jika berhasil
                if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
                    $updateData['settlement_time'] = now();
                }

                $transaction->update($updateData);

                Log::info("Transaction {$orderId} updated successfully", [
                    'new_status' => $transactionStatus,
                ]);
            } else {
                // Transaksi tidak ditemukan di database
                // Simpan sebagai transaksi baru
                Transaction::create([
                    'order_id' => $orderId,
                    'gross_amount' => (int) $grossAmount,
                    'payment_type' => $paymentType,
                    'transaction_status' => $transactionStatus,
                    'status_code' => $statusCode,
                    'transaction_id' => $transactionId,
                    'fraud_status' => $fraudStatus,
                    'payload' => $request->all(),
                    'settlement_time' => ($transactionStatus === 'settlement') ? now() : null,
                ]);

                Log::info("Transaction {$orderId} created from callback");
            }

            // Response ke Midtrans (WAJIB untuk webhook)
            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error processing notification',
            ], 500);
        }
    }

    /**
     * Handle finish URL (setelah payment di Midtrans)
     */
    public function finish(Request $request)
    {
        $orderId = $request->get('order_id');
        $status = $request->get('status');

        // Update status di database jika ada
        if ($orderId) {
            $transaction = Transaction::where('order_id', $orderId)->first();
            if ($transaction && $transaction->transaction_status !== 'settlement') {
                $transaction->update([
                    'transaction_status' => 'settlement',
                    'settlement_time' => now(),
                ]);
            }
        }

        return view('payment.finish', [
            'order_id' => $orderId,
            'status' => $status,
            'message' => 'Transaksi berhasil diproses',
        ]);
    }

    /**
     * Handle unfinish URL (jika customer tidak menyelesaikan payment)
     */
    public function unfinish(Request $request)
    {
        $orderId = $request->get('order_id');

        return view('payment.unfinish', [
            'order_id' => $orderId,
            'message' => 'Transaksi belum selesai. Silakan ulangi pembayaran.',
        ]);
    }

    /**
     * Handle error URL (jika terjadi error)
     */
    public function error(Request $request)
    {
        $orderId = $request->get('order_id');
        $status = $request->get('status');

        return view('payment.error', [
            'order_id' => $orderId,
            'status' => $status,
            'message' => 'Terjadi kesalahan dalam transaksi. Silakan hubungi customer service.',
        ]);
    }

    /**
     * Check status transaksi
     */
    public function checkStatus($orderId)
    {
        try {
            $status = CoreApi::status($orderId);

            // Update database dengan status terbaru
            $transaction = Transaction::where('order_id', $orderId)->first();
            if ($transaction) {
                $transaction->update([
                    'transaction_status' => $status->transaction_status,
                    'payment_type' => $status->payment_type,
                    'status_code' => $status->status_code,
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $status,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Status Check Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil status: ' . $e->getMessage(),
            ], 500);
        }
    }
}