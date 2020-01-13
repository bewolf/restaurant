@extends('layouts.app')
@section('content')
<div class="row justify-content-center mb-4">
    <h1>Order № {{$id}}</h1>
</div>
<div class="row text-center border-bottom mb-2">
    <div class="row col-md-12">
        <h4 class="col-md-3">Product</h4>
        <h4 class="col-md-3">Quantity</h4>
        <h4 class="col-md-3">Price per unit</h4>
        <h4 class="col-md-3">Total price</h4>
    </div>
    <div style="display: none">
        {{ $total = 0 }}
    </div>
    @foreach ($order as $product)
        <div class="row col-md-12">
            <div class="col-md-3">{{$product->name}}</div>
            <div class="col-md-3">{{$product->product_quantity}}</div>
            <div class="col-md-3">{{$product->product_price}}</div>
            <div class="col-md-3">{{$product->product_price * $product->product_quantity}}</div>
        </div>
        <div style="display: none">{{$total += $product->product_price * $product->product_quantity}}</div>
    @endforeach
    <div class="row col-md-12 justify-content-center">
        Grand total: {{ $total }}
    </div>
</div>
<div class="row">
    <a href="{{route('home')}}" class="btn btn-success m-1">Home</a>
    <a href="{{route('statistics.orders.today')}}" class="btn btn-success m-1">Today orders</a>
</div>
@endsection