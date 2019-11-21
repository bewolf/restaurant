<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodsProducts extends Model
{
    protected $fillable = [
        'food_id', 'product_id', 'quantity'
    ];
}