@extends('layouts.app')
@section('content')
    <div><h1>Invoices</h1></div>
    <table class="table">
        <tr>
            <th scope="col">Invoice number</th>
            <th scope="col">Date</th>
            <th scope="col">View invoice</th>
        </tr>
        @foreach($invoices as $invoice)
            <tr>
                <td>{{$invoice->number}}</td>
                <td>{{$invoice->created_at}}</td>
                <td><a class="btn btn-info" href="#">Show invoice</a></td>
            </tr>
        @endforeach
    </table>

@endsection
