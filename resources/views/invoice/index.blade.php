@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mb-3"><h1>Invoices</h1></div>
    <div class="row col-md-10">
        <table class="table">
            <tr>
                <th scope="col">Invoice number</th>
                <th scope="col">Date</th>
                <th scope="col">View invoice</th>
            </tr>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{$invoice->number}}</td>
                    <td>{{$invoice->created_at->toDateString()}}</td>
                    <td><a class="btn btn-info" href="{{route('invoice.show', [$invoice->number])}}">Show invoice</a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $invoices->links() }}

        <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to Home</a>
    </div>
@endsection
