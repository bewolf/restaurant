<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function foods()
    {
       return $this->belongsToMany(Food::class, 'foods_products');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'quantity', 'unit', 'sell_price', 'sell_quantity_base', 'product_type'
    ];
}