<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'order_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'gross_amount',
        'payment_type',
        'transaction_status',
        'status_code',
        'transaction_id',
        'fraud_status',
        'payload',
        'settlement_time',
        'description',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'gross_amount' => 'integer',
        'payload' => 'array',
        'settlement_time' => 'datetime',
    ];

    /**
     * Transaction status constants
     */
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_SETTLEMENT = 'settlement';
    const STATUS_DENY = 'deny';
    const STATUS_EXPIRE = 'expire';
    const STATUS_CANCEL = 'cancel';
    const STATUS_REFUND = 'refund';
    const STATUS_CHALLENGE = 'challenge';

    /**
     * Check if transaction is successful
     */
    public function isSuccessful(): bool
    {
        return in_array($this->transaction_status, [
            self::STATUS_SUCCESS,
            self::STATUS_SETTLEMENT,
        ]);
    }

    /**
     * Check if transaction is pending
     */
    public function isPending(): bool
    {
        return $this->transaction_status === self::STATUS_PENDING;
    }

    /**
     * Check if transaction is failed
     */
    public function isFailed(): bool
    {
        return in_array($this->transaction_status, [
            self::STATUS_DENY,
            self::STATUS_EXPIRE,
            self::STATUS_CANCEL,
        ]);
    }

    /**
     * Format amount for display
     */
    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->gross_amount, 0, ',', '.');
    }
}