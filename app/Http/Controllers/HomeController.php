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
        $query = "SELECT o.user_id, o.table_id, o.order_id
                    FROM orders AS o
                    LEFT JOIN products AS p
                    ON o.product_id = p.id
                    WHERE o.user_id = $current_user_id
                    AND ISNULL(o.finished_at)
                    GROUP BY  o.table_id, o.user_id, o.order_id";

        $orders = DB::select($query);
        $tables = Tables::all();
        return view('home', compact('orders', 'tables'));
    }
}
