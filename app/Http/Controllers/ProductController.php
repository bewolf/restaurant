<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductUpdateRequest;
use App\Models\Food;
use App\Models\FoodsProducts;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
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
        $min_quantity = 10;

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
     */
    public function edit($id)
    {
        $query = "SELECT 
                    p.id, p.name, p.unit, p.sell_price, p.sell_quantity_base, pt.type, ROUND(AVG(invoices.unit_price),2) as avg_price
                    FROM products AS p
                    LEFT JOIN product_types AS pt
                    ON p.product_type = pt.id
                    LEFT JOIN invoices
                    ON invoices.product_id = p.id
                    WHERE p.id = '$id'
                    GROUP BY p.id, p.name, p.unit, p.sell_price, p.sell_quantity_base, pt.type
                    ";

        $product = DB::select($query);
        $units = ['kg', 'grams', 'qty.', 'cm', 'liters'];
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