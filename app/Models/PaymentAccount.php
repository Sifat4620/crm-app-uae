<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $fillable = ['gateway_id', 'account_name', 'account_number', 'status'];

    public function gateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }
}
