<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Tables;
use App\Models\OrdersDetails;

class OrderController extends Controller
{

    public function create(int $table)
    {
        $products = Product::get();
        $types = ProductType::get();
        $order_id = $this->findOrder($table);
        $order_details = null;

        if ($order_id) {
            $order_details = $this->getOrderDetails($order_id);
        }

        return view('orders.create', compact('products', 'types', 'order_id', 'order_details'));
    }

    public function edit($order)
    {
        $order = Order::where('order_id', '=', $order)->get();
        return view('orders.edit', compact('order'));
    }

    public function update($order_id)
    {
    }

    public function process(CreateOrderRequest $request, int $order_id)
    {
        $table_id = $request->input('table_id');
        $message = 'Successfully update order';

        if (!$order_id) {
            $order_id = $this->createOrder($table_id);
            $message = 'Successfully create order';
        }

        $success = $this->updateOrderDetails($order_id, $request->all());

        if (!$success) {

            return redirect()->back()->with('error', 'Not enough quantity');
        }

        return redirect()->route('order.create', ['table' =>  $table_id])->with('success', $message);
    }

    public function close(int $order_id)
    {
        $bill_amount = $this->getFinalBillAmount($order_id);
        $order = Order::findOrFail($order_id);
        $order->update([
            'bill_amount' => $bill_amount,
            'finished_at' => date("Y-m-d H:i:s")
        ]);

        Tables::where('id', $order->table_id)->update(['is_available' => true]);

        return redirect()->route('home')->with('success', "Order № $order->id was successfully closed with total amount of $bill_amount.");
    }

    private function getFinalBillAmount(int $order_id)
    {
        $order_details = OrdersDetails::getDetails($order_id);

        $total = 0;

        foreach ($order_details as $order) {

            $total += $order->product_quantity * $order->product_price;
        }

        return $total;
    }

    private function createOrder($table_id)
    {
        $data['table_id'] = $table_id;
        $data['user_id'] = auth()->id();
        $order = Order::create($data);

        Tables::where('id', $table_id)->update(['is_available' => false]);

        return $order->id;
    }

    private function updateOrderDetails(int $order_id, array $data)
    {
        $products = $data['products'];
        $quantities = $data['quantities'];

        $is_all_products_available = $this->checkProductsQuantity($products, $quantities);

        if (!$is_all_products_available) {
            return false;
        }

        $this->writeInDb($order_id, $products, $quantities);

        return true;
    }

    private function checkProductsQuantity(array $products, array $quantities)
    {
        for ($i = 0; $i < count($products); $i++) {
            $product = Product::findByName($products[$i])->first();
            $is_available = $product->checkQuantity($quantities[$i]);

            if (!$is_available) {
                return false;
            }
        }

        return true;
    }

    private function writeInDb(int $order_id, array $products, array $quantities)
    {
        for ($i = 0; $i < count($products); $i++) {
            $product = Product::findByName($products[$i])->first();
            $product->updateQuantity($quantities[$i]);

            OrdersDetails::insert([
                'order_id' => $order_id,
                'product_id' => $product->id,
                'product_quantity' => $quantities[$i],
                'product_price' => $product->sell_price,
                'created_at' => now(),
            ]);
        }

        return true;
    }

    private function findOrder(int $table_id)
    {
        $table = Tables::findOrFail($table_id);

        if ($table->is_available) {
            return 0;
        }

        return Order::where('table_id', $table_id)->latest()->first()->id;
    }

    private function getOrderDetails($order_id)
    {
        return OrdersDetails::getDetails($order_id);
    }
}
