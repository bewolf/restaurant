@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Warehouse</h1>
        <div class="col-md-9 py-3">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="thead-dark text-center">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as  $product)
                    <tr class="text-center">
                        <td>{{ $product->name }}</td>
                        <td @if($product->quantity < 10) class="alert-danger" @endif>{{ $product->quantity }}</td>
                        <td>{{ $product->unit }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
        </div>
    </div>
@endsection