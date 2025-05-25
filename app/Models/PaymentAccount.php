<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $fillable = [
        'holder_name',
        'bank_name',
        'account_number',
        'branch',
        'gateway_id', // only if present in your migration, else remove
        'status',     // only if present in your migration, else remove
    ];


    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
