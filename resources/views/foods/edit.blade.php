@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Edit <a href="{{route('food.show', $food)}}">{{$food->name}} </a></h1>
    <div class="row col-md-10 mb-4">
        <form class="row" method="post" action="{{route('food.update', $food)}}">
            @csrf
            @method('patch')
            {{--<input type="text" hidden name="food" value="">--}}
            <div class="form-group col-md-7">
                <label for="sell_price">
                    <input type="text" name="sell_price" class="form-control" value="{{$food->sell_price}}">
                </label>
            </div>

            @foreach($products_data as $product)
                <div class="form-group col-md-6">
                    <label class="d-inline-block" for="name">Product</label>
                    <select class="form-control" name="products[]">
                        @foreach($warehouse as $item)
                            <option value="{{$item->id}}"{{$item->name == $product->name ? 'selected' : ''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label class="d-inline-block" for="unit">Unit</label>
                    <input class="form-control" type="text" disabled value="{{$product->unit}}">
                </div>

                <div class="form-group col-md-2">
                    <label class="d-inline-block" for="unit">Quantity</label>
                    <input name="quantity[]" class="form-control" type="text"
                           value="{{$product->product_quantity}}">
                </div>
            @endforeach

            <div class="row col-md-4 ml-0">
                <button type="submit" class="btn btn-secondary">Edit</button>
            </div>
        </form>
    </div>

    <div class="d-inline-block">
        <form method="post" action="{{route('food.destroy', $food->id)}}" onclick="return confirm('Are you sure?')">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger">Remove</button>
        </form>
    </div>

    <a class="btn btn-primary m-2" href="{{route('food.index')}}">Back to Foods</a>
    <a class="btn btn-primary m-2" href="{{route('home')}}">Back to Home</a>

    </div>
@endsection
