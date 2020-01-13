@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-4">
    <h1>Today orders</h1>
</div>
<div class="row text-center">
    @if (count($orders) > 0)
        <div class="row col-md-12">
            <h4 class="col-md-3">Order id</h4>
            <h4 class="col-md-3">Waiter name</h4>
            <h4 class="col-md-3">Table №</h4>
            <h4 class="col-md-3">Order opened at</h4>
        </div>
        @foreach ($orders as $order)
            <div class="row col-md-12">
                <div class="col-md-3">
                    <a href="{{ route('order.show', $order->id)}}" class="btn btn-success m-1">{{$order->id}}</a>
                </div>
                <div class="col-md-3">{{$order->name}}</div>
                <div class="col-md-3">{{$order->table_id}}</div>
                <div class="col-md-3">{{date('H:i',strtotime($order->created_at))}}</div>
            </div>
        @endforeach
    @else
        <div class="row">No orders yet.</div>
    @endif
</div>
@endsection