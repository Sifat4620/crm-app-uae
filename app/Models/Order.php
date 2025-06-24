<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Keep the column names here that can not be mass assignable
     * @var array
     */
    protected $guarded = [];

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

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

        public function billingCycle()
    {
        return $this->belongsTo(BillingCycle::class);
    }


    
    

}
