@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Products</h1>
        <div class="col-md-9 py-3">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Bought Price</th>
                    <th>Sell Price</th>
                    <th>Import</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as  $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->bought_price}}</td>
                        <td>{{ $product->sell_price }}</td>
                        <td><a class="btn btn-secondary" href="#">Import</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{route('home')}}">Back to admin panel</a>
        </div>
    </div>
@endsection