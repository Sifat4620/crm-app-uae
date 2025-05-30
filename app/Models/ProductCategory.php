<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    // Add 'name' and 'description' to the fillable array
    protected $fillable = ['name', 'description'];

    // Define the relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
