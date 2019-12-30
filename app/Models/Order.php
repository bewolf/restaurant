<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id' ,'table_id', 'bill_amount', 'finished_at'
    ];

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_id');
    // }
}