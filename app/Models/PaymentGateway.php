<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Helper to check if active
    public function isActive(): bool
    {
        return $this->active;
    }
}
