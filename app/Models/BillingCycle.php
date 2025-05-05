<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingCycle extends Model
{
    // Set the table name if it's not pluralized correctly
    protected $table = 'billing_cycles';

    // Define the fillable fields (or you can use $guarded if you want to block mass assignment)
    protected $fillable = ['cycle_name', 'duration_in_days'];

    // Define the relationship with orders (many-to-many)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_billing_cycle', 'billing_cycle_id', 'order_id');
    }
}
