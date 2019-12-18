@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>Edit Product: {{$product[0]->name}}</h1>
    </div>
    <div class="row">
        <form action="{{route('products.update', $product[0]->id)}}" method="post">
            @csrf
            @method('patch')
            <input type="text" name="id" value="{{$product[0]->id}}" hidden>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-control"
                       value="{{$product[0]->name}}">
            </div>
            <div class="form-group">
                <p>Average bought price: {{$product[0]->avg_price}} per {{$product[0]->unit}}</p>
            </div>
            <div class="form-group">
                <label for="sell_price">Sell price</label>
                <input type="number"
                       id="sell_price"
                       name="sell_price"
                       class="form-control"
                       min="0"
                       step="0.1"
                       value="{{$product[0]->sell_price}}">
            </div>
            <div class="form-group">
                <label for="sell_quantity_base">Sell quantity base</label>
                <input type="number"
                       id="sell_quantity_base"
                       name="sell_quantity_base"
                       class="form-control"
                       min="0"
                       step="0.01"
                       value="{{$product[0]->sell_quantity_base}}">
            </div>
            <div class="form-group">
                <label for="unit">Unit</label>
                <select name="unit" id="unit" class="form-control">
                    @foreach($units as $unit)
                        <option class="form-control"
                                {{$unit == $product[0]->unit ? 'selected' : ''}}
                                value="{{$unit}}">{{$unit}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="type">Product type</label>
                <select name="product_type" id="type" class="form-control">
                    @foreach($types as $type)
                        <option class="form-control"
                                {{$type->type == $product[0]->type? 'selected' : ''}}
                                value="{{$type->id}}">{{$type->type}}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" class="btn btn-success" value="Edit">
        </form>
    </div>
@endsection