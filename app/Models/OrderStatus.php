<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    // Table name if not default 'order_statuses'
    // protected $table = 'order_statuses';

    // Fillable fields for mass assignment
    protected $fillable = [
        'status_name',
    ];

    // If you use timestamps, leave this as is; otherwise disable:
    // public $timestamps = true;
}
