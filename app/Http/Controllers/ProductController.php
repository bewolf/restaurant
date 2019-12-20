<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Food;
use App\Models\FoodsProducts;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    const UNIT_TYPES = ['kg', 'grams', 'qty.', 'cm', 'liters'];
    const MIN_QUANTITY_FOR_MESSAGE = 10;

    public function __construct()
    {
        $this->middleware('can:manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = 'SELECT 
                    ROUND(AVG(unit_price),2) as avg_price, products.name, products.quantity, products.unit, products.sell_price, products.id, product_types.type
                    FROM invoices 
                    INNER JOIN products 
                    ON products.id = invoices.product_id
                    LEFT JOIN product_types
                    ON products.product_type = product_types.id 
                    GROUP BY products.name, quantity,unit, products.sell_price, products.id, product_types.type';

        $products = DB::select($query);
        $product_types = ProductType::all();
        $min_quantity = self::MIN_QUANTITY_FOR_MESSAGE;

        return view('products.index', compact(['products', 'min_quantity', 'product_types']));
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
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     */
    public function edit($id)
    {
        $query = "SELECT 
                    products.id, products.name, products.unit, products.sell_price, products.sell_quantity_base, product_types.type, ROUND(AVG(invoices.unit_price),2) as avg_price
                    FROM products
                    LEFT JOIN product_types
                    ON products.product_type = product_types.id
                    LEFT JOIN invoices
                    ON invoices.product_id = products.id
                    WHERE products.id = '$id'
                    GROUP BY products.id, products.name, products.unit, products.sell_price, products.sell_quantity_base, product_types.type";

        $product = DB::select($query);
        $units = self::UNIT_TYPES;
        $types = ProductType::get();

        return view('products.edit', compact('product', 'units', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $name
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('products.edit', $request->id)->with('success', 'Successful update product.');
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
}