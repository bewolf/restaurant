@extends('layouts.app')

@section('content')
<div class="row justify-content-center mb-4">
    <h1>Custom period orders</h1>
</div>

<form action="{{route('statistics.orders')}}" id="orders_search_form">

    <div class="row">
        <div class="row col-md-3">
            <label for="start_date">Start Date</label>
            <input class="form-control" type="date" name="start_date" value='<?= date('Y-m-d');?>' min="2019-01-01">
        </div>
        <div class="row col-md-3">
            <label for="end_date">End Date</label>
            <input class="form-control" type="date" name="end_date" id="end_date" value='<?= date('Y-m-d');?>'
                min="2019-01-01">
        </div>
    </div>
    <input type="submit" class="row btn btn-success mt-3" value="Search">
</form>
@if (count($orders) > 0)
<div class="row text-center">
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
</div>
@endif
@endsection