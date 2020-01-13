<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = [
        'user_id' ,'table_id', 'bill_amount', 'finished_at'
    ];

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_id');
    // }

    public static function getTodayOrders()
    {
        $query = "SELECT orders.id, orders.table_id, users.name, orders.created_at
        FROM orders
        LEFT JOIN users ON orders.user_id = users.id
        WHERE DATE(orders.created_at) = CURRENT_DATE ";

        $orders = DB::select($query);

        return $orders;
    }
}