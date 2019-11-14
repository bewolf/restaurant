<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('can:shift_manager', ['only' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        $minQuantity = 10;

        return view('products.index', compact(['products', 'minQuantity']));
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Product $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $warehouse)
    {
        //
    }
}
