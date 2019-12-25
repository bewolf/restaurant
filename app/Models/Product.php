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

    public static function findByName($name)
    {
        return self::where('name', $name);
    }

    public function checkQuantity(int $quantity)
    {
        
        $sell_quantity_base = $this->sell_quantity_base;
        $product_quantity = $this->quantity;
        $max_orders = $product_quantity / $sell_quantity_base;
        
        if ($quantity <= $max_orders) {
            return true;
        }

        return false;
    }

    public function updateQuantity(int $quantity)
    {
        $this->quantity -= $quantity * $this->sell_quantity_base; 
        $this->save();
    }
}