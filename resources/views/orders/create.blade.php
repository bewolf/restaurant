@extends('layouts.app')
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/create_new_order_page.js') }}"></script>
@endsection

@section('content')
    <h1 class="col-md-10 text-center" xmlns="http://www.w3.org/1999/html">New order on table № {{$_GET['table']}}</h1>
    <div class="row col-md-5 float-left mr-2 ml-2">
        <form id="order_form" action="{{route('order.store')}}" method="post">
            @csrf
            <div class="form-group">
                <h4>Order № {{$order_num}}</h4>
            </div>
            <div id="order_form_body">
                <input type="number" name="table_num" readonly hidden value="{{$_GET['table']}}">
                <input type="number" name="order_num" readonly hidden value="{{$order_num}}">

            </div>
            <div class="row">
                <input class="btn btn-success col-md-10" type="submit">
            </div>
        </form>
    </div>

    <div class="row col-md-5">
        <div>
            <h3 class="text-center">Filter</h3>
            <div class="row" id="product_types_filter">
                @foreach($types as $type)
                    <button class="btn btn-danger float-left mr-1 mb-1"
                            id="type_{{$type->id}}">{{$type->type}}
                    </button>
                @endforeach
            </div>
            <div id="displayed_products">
                <h3 class="text-center">Products</h3>
                @foreach($types as $type)
                    <div id="products_from_type_{{$type->id}}" class="row" hidden>
                        @foreach($products as $product)
                            @if($product->product_type == $type->id)
                                <button
                                        class="btn btn-info float-left mr-1 mb-1"
                                        id="{{$product->id}}">
                                    {{$product->name}}
                                </button>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div id="product_for_cart" hidden>
                <div class="row">
                    <p id="current_product_for_cart" class="float-left mr-2"></p>
                    <p id="current_product_for_cart_delimiter">&nbsp;:&nbsp;</p>
                    <p id="current_product_for_cart_quantity"></p>
                </div>
                <div>
                    <button id="quantity_increase"
                            class="btn btn-success float-left mr-2"
                            onclick="increaseQuantity()">+
                    </button>
                    <button id="quantity_decrease"
                            class="btn btn-danger float-left mr-4"
                            onclick="decreaseQuantity()">-
                    </button>

                    <button id="add_to_order" class="btn btn-info" onclick="addOrderRow()">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection