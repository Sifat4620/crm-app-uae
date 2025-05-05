<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';  // specify the table if it's different
    protected $fillable = [
        'client_id', 'product_id', 'status', 'quantity', 'total_price'
    ];

    // Define relationships or other methods if needed
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function billingCycles()
    {
        return $this->belongsToMany(BillingCycle::class, 'order_billing_cycle', 'order_id', 'billing_cycle_id');
    }
}
