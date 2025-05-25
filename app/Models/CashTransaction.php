<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CashTransaction extends Model
{
    protected $fillable = [
        'payment_account_id',  
        'transaction_number',
        'order_id',           // assuming transaction belongs to an order
        'amount',
        'type',
        'notes',
    ];

    /**
     * Payment Account relationship
     */
    public function paymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class, 'payment_account_id');
    }

    /**
     * Related Order (assuming cash transaction linked to order)
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Client via order relationship shortcut
     */
    public function client()
    {
        return $this->order ? $this->order->client() : null;
    }

    /**
     * Product via order relationship shortcut
     */
    public function product()
    {
        return $this->order ? $this->order->product() : null;
    }


    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Billing Cycle via order relationship shortcut
     */
    public function billingCycle()
    {
        return $this->order ? $this->order->billingCycle() : null;
    }

    /**
     * Boot method to auto-generate transaction number on create (optional)
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_number)) {
                $transaction->transaction_number = 'TRX-' . strtoupper(Str::random(8));
            }
        });
    }
}
