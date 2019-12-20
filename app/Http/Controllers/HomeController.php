<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $current_user_id = auth()->id();
        $query = "SELECT orders.user_id, orders.table_id, orders.order_id
                    FROM orders
                    LEFT JOIN products
                    ON orders.product_id = products.id
                    WHERE orders.user_id = $current_user_id
                    AND ISNULL(orders.finished_at)
                    GROUP BY  orders.table_id, orders.user_id, orders.order_id";

        $orders = DB::select($query);
        $tables = Tables::all();
        return view('home', compact('orders', 'tables'));
    }
}