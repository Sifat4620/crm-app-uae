<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashTransaction extends Model
{
    protected $fillable = ['account_id', 'amount', 'type', 'description', 'transaction_date'];

    public function account()
    {
        return $this->belongsTo(PaymentAccount::class);
    }
}
