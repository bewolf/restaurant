<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductTypeRequest;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
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
        $product_types = ProductType::paginate(10);
        return view('product_types.index', compact('product_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductTypeRequest $request)
    {
        $product_type = $request->product_type;
        ProductType::insert([
            'type' => $product_type
        ]);

        return redirect()->route('product-types.index')->with('success', 'Successful add Product Type');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateProductTypeRequest $request, $id)
    {
        ProductType::where('id', '=', $id)
            ->update(['type' => $request->product_type]);

        return redirect()->route('product-types.index')->with('success', 'Successful update Product Type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (count(Product::where('product_type', '=', $id)->get()) == 0) {
            ProductType::destroy($id);

            return redirect()->route('product-types.index')->with('success', 'Successful deleted Product Type');
        }

        return redirect()->route('product-types.index')->with('error', 'Can not delete this Product Type. This product type is used in some Products.');
    }
}
