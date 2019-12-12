<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsUpdateSellPriceRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:shift_manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = 'SELECT 
	                ROUND(AVG(unit_price),2) as avg_price, products.name, products.quantity, products.unit, products.sell_price, products.id, products.is_drink 
                    FROM invoices 
                    INNER JOIN products 
                    ON products.id = invoices.product_id 
                    GROUP BY products.name, quantity,unit, products.sell_price, products.id, products.is_drink';

        $products = DB::select($query);
        $min_quantity = 10;

        return view('products.index', compact(['products', 'min_quantity']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductsUpdateSellPriceRequest $request, $name)
    {
        Product::where('name', $name)->update(['sell_price' => $request->sell_price]);

        return redirect()->route('products.index')->with('success', 'Successful update product sell price.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $warehouse
     * @return void
     */
    public function destroy(Product $warehouse)
    {
        //
    }

    public function isADrink(Request $request)
    {
        Product::where('id', $request->id)->update([
            'is_drink' => $request->has('is_drink')
        ]);

        return back();
    }
}