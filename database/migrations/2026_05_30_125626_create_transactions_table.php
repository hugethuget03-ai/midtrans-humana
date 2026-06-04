<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique()->comment('Unique order ID from Midtrans');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->bigInteger('gross_amount')->comment('Total amount in Rupiah');
            $table->string('payment_type')->nullable()->comment('Payment method used');
            $table->string('transaction_status')->nullable()->comment('Transaction status from Midtrans');
            $table->string('status_code')->nullable()->comment('Midtrans status code');
            $table->string('transaction_id')->nullable()->comment('Midtrans transaction ID');
            $table->string('fraud_status')->nullable()->comment('Fraud status if any');
            $table->json('payload')->nullable()->comment('Full payload from Midtrans');
            $table->timestamp('settlement_time')->nullable()->comment('When transaction was settled');
            $table->text('description')->nullable();
            $table->timestamps();

            // Indexes for faster queries
            $table->index('order_id');
            $table->index('transaction_status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};