<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'table_id', 'product_id', 'product_quantity', 'finished_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_id');
    }
}