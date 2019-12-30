<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrdersDetails extends Model
{
    protected $table = 'orders_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_quantity',
        'product_price',
        'created_at',
    ];

    public static function getDetails($order_id)
    {
        $query = "SELECT products.name, product_quantity, product_price
                    FROM orders_details
                    LEFT JOIN products ON products.id = orders_details.product_id
                    WHERE order_id = $order_id";

        $result = DB::select($query);
        return $result;
    }
}
