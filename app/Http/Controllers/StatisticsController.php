<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Tables;
use App\Models\User;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select(['id', 'name'])->get()->toArray();
        $tables = Tables::all()->pluck('id');
        $products = Product::select('id', 'name')->get()->toArray();
        $product_types = ProductType::select('id', 'type')->get()->toArray();

        return view('statistics.index', compact('users', 'tables', 'products', 'product_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $users = User::select(['id', 'name'])->get()->toArray();
        $tables = Tables::all()->pluck('id');
        $products = Product::select('id', 'name')->get()->toArray();
        $product_types = ProductType::select('id', 'type')->get()->toArray();

        return view('statistics.index', compact('users', 'tables', 'products', 'product_types', 'result'));
    }

    public function todayOrders()
    {
        $orders = Order::getTodayOrders();

        return view('statistics.today_orders', compact('orders'));
    }

    public function customPeriodOrders()
    {
        $orders = [];
        if (request()->all()) {
            request()->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $start_date = request()->start_date;
            $end_date = request()->end_date . ' 23:59:59';

            $orders = Order::customPeriodOrders($start_date, $end_date);
        }
        return view('statistics.custom_period_orders', compact('orders'));
    }
}
