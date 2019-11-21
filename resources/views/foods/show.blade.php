@extends('layouts.app')
@section('content')

    <div class="row justify-content-center mb-3"><h1>{{$food->name}} ingredients</h1></div>
    <div class="row col-md-10 py-3">
        <table class="table text-center">
            <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Unit</th>
                <th scope="col">Quantity</th>
            </tr>
            </thead>
            <tbody class="table table-striped">
            @foreach($food->products as $key => $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->unit}}</td>
                    <td>{{$quantity[$key]}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a class="btn btn-primary m-2" href="{{route('food.index')}}">Back to Foods</a>
        <a class="btn btn-primary m-2" href="{{route('home')}}">Back to Home</a>
        <a class="btn btn-secondary m-2" href="{{route('food.edit', $food)}}">Edit</a>

    </div>
@endsection
