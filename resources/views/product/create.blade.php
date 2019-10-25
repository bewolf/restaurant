@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">

        <h1 class="col-md-12 text-center">Add product</h1>

        <div class="col-md-6">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="post" action="{{route('product.store')}}">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" id="quantity" class="form-control" name="quantity" placeholder="Quantity"
                           required>
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit"
                           required>
                </div>
                <div class="form-group">
                    <label for="bought_price">Bought price</label>
                    <input type="text" name="bought_price" class="form-control" id="bought_price" placeholder="Bought price"
                           required>
                </div>
                <div class="form-group">
                    <label for="sell_price">Sell price</label>
                    <input type="text" name="sell_price" class="form-sell_price" id="sell_price"
                           placeholder="Sell price" required>
                </div>

                <button type="submit" class="btn btn-primary">Add product</button>
            </form>
            <a class="btn btn-primary mt-2" href="{{route('admin_panel')}}">Back to admin panel</a>

        </div>

    </div>

@endsection