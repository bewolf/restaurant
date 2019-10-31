<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'number', 'product_name', 'quantity', 'unit', 'unit_price',
    ];
}
