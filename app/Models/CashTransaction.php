<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model
{
    protected $fillable = [
        'payment_account_id',  // match DB column
        'transaction_number',
        'amount',
        'type',
        'notes',
    ];

    public function account()
    {
        return $this->belongsTo(PaymentAccount::class, 'payment_account_id');
    }
}
