<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Tables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function create()
    {
        $products = Product::get();
        $types = ProductType::get();
        $order_num = DB::select('SELECT MAX(order_id) as num_of_orders FROM orders')[0]->num_of_orders;

        if (null === $order_num) {
            $order_num = 1;
        } else {
            ++$order_num;
        }

        return view('orders.create', compact('products', 'types', 'order_num'));
    }

    public function edit($order)
    {
        $order = Order::where('order_id', '=', $order)->get();
        return view('orders.edit', compact('order'));

    }

    public function update($order_id)
    {
    }

    public function store(CreateOrderRequest $request)
    {
        $table_num = $request->table_num;
        $order_num = $request->order_num;
        $products = $request->product;
        $quantity = $request->quantity;
        $products_data = [];
        $insufficient_quantity = [];

        // Group if entered duplicate product name
        for ($i = 0; $i < count($products); $i++) {

            if (array_key_exists($products[$i], $products_data)) {

                $products_data += $quantity[$i];
            } else {

                $products_data[$products[$i]] = $quantity[$i];
            }
        }

        // Check Products availability
        foreach ($products_data as $key => $ordered_quantity) {

            $current_product = Product::where('name', $key)->get()->toArray();
            $current_product_sell_quantity_base = $current_product[0]['sell_quantity_base'];
            $current_product_quantity = $current_product[0]['quantity'];
            $max_orders = $current_product_quantity / $current_product_sell_quantity_base;

            if ($ordered_quantity > $max_orders) {

                $insufficient_quantity[$key] = $ordered_quantity - $max_orders;
            }
        }
        // If there is insufficient availability of some Product
        if ($insufficient_quantity) {
            dd('TODO');
            return back()->withInput();
        }

        //Create Order, update Products and Table if everything is OK
        foreach ($products_data as $key => $ordered_quantity) {

            $current_product = Product::where('name', $key)->get()->toArray();
            $current_product_sell_quantity_base = $current_product[0]['sell_quantity_base'];
            $current_product_quantity = $current_product[0]['quantity'];
            $ordered_quantity_with_base = $ordered_quantity * $current_product_sell_quantity_base;

            Product::where('name', $key)->update(['quantity' => $current_product_quantity - $ordered_quantity_with_base]);
            Order::insert([
                'table_id' => $table_num,
                'user_id' => auth()->id(),
                'order_id' => $order_num,
                'product_id' => $current_product[0]['id'],
                'product_quantity' => $ordered_quantity,
            ]);
        }

        Tables::where('id', $table_num)->update(['is_available' => false]);

        return redirect()->route('home')->with('success', 'Successfully create order');


    }

    private function array_has_dupes($array)
    {
        return count($array) !== count(array_unique($array));
    }
}
