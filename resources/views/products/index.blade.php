@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Warehouse</h1>
        <div class="col-md-9 py-3">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark text-center">
                <tr>
                    <th >Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Avg. Price</th>
                    <th>Sell Price</th>
                    <th>Set Sell Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as  $product)
                    <tr class="text-center">
                        <td>{{ $product->product_name }}</td>
                        <td @if($product->quantity < $minQuantity) class="badge-danger"  title='Please order'@endif>{{ $product->quantity }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->avg_price}}</td>
                        <td @if($product->sell_price == 0) class="badge-danger" title='Change sell price'@endif>{{ $product->sell_price}}</td>
                        <td>
                            <form method="post" action="{{route('products.update', $product->product_name)}}">
                                @csrf
                                @method('patch')
                                <input name="sell_price" class="form-control float-left col-md-2" type="text">
                                <input class="form-control col-md-2 btn btn-success" type="submit" value="Set">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
        </div>
    </div>
@endsection