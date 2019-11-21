<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    public function products()
    {
        return $this->belongsToMany(Product::class, 'foods_products');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
    ];

    public static function addFood($request)
    {
        $food = Food::create($request);

        for ($i = 0; $i < count($request['quantity']); $i++) {
            $data[] = [
                'food_id' => $food->id,
                'product_id' => Product::where('name', $request['food_products'][$i])->pluck('id')->first(),
                'product_quantity' => $request['quantity'][$i],
            ];
        }
        FoodsProducts::insert($data);

        return redirect()->route('food.create')->with('success', 'Successful added food ');
    }
}