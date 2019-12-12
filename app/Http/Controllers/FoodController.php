<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodStoreRequest;
use App\Models\Food;
use App\Models\FoodsProducts;
use App\Models\Product;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:shift_manager');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::paginate(10);

        return view('foods.index', compact('foods'));
    }


    public function show(Food $food)
    {
        $quantity = FoodsProducts::where('food_id', $food->id)->pluck('product_quantity');

        return view('foods.show', compact(['food', 'quantity']));
    }


    public function edit(Food $food)
    {
        $products_data = Product::join('foods_products', 'products.id', '=', 'foods_products.product_id')->where('food_id', $food->id)->get();
        $warehouse = Product::get();

        return view('foods.edit', compact(['food', 'warehouse', 'products_data']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products_data = Product::get();
        $products = [];

        foreach ($products_data->all() as $product) {
            $products[$product['name']] = $product['unit'];
        }

        return view('foods.create', compact('products'));
    }


    public function destroy($id)
    {
        FoodsProducts::where('food_id', $id)->delete();

        Food::destroy($id);

        return redirect()->route('food.index')->with('success', 'Successful remove receipt');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FoodStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodStoreRequest $request)
    {
        return Food::addFood($request->all());
    }


    public function update(Request $request)
    {

        $food = Food::find($request->food);
        $food->update(array('sell_price' => $request->sell_price));
        $products = $request->products;
        $quantity = $request->quantity;

        $food->products()->detach();
        foreach ($products as $key => $product) {

            FoodsProducts::insert([
                'food_id' => $food->id,
                'product_id' => $product,
                'product_quantity' => $quantity[$key],
            ]);
        }
        return redirect()->route('food.edit', $food->id)->with('success', 'Successful update receipt');
    }
}
