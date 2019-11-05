@extends('layouts.app')
@section('content')
    <div><h3>Invoice Num. {{$invoiceData[0]->number}} </h3></div>
    <div><h3>Invoice Date. {{$invoiceData[0]->created_at->format('d.M.Y.')}} </h3></div>
    <table class="table">
        <tr>
            <th scope="col">Product name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit</th>
            <th scope="col">Unit price</th>
            <th scope="col">Total price</th>
        </tr>
        @foreach($invoiceData as $data)
            <tr>
                <td>{{$data->product_name}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->unit}}</td>
                <td>{{$data->unit_price}}</td>
                <td>{{$data->unit_price * $data->quantity}}</td>
            </tr>
        @endforeach

    </table>
    <a class="btn btn-primary mt-2" href="{{route('invoice.index')}}">Back to invoices</a>

    <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to admin panel</a>

@endsection
