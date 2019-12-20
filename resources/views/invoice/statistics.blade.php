@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mb-3"><h1>Invoices stats</h1></div>
    <div class="row mb-2">
        <form action="{{route('invoice-statistics')}}" id="search_form">

            <div class="row">
                <div class="row m-3 col-md-3">
                    <label for="start_date">Start Date</label>
                    <input class="form-control" type="date" name="start_date"
                           value='<?= date('Y-m-d', strtotime('-7 days'));?>'
                           min="2019-01-01">
                </div>
                <div class="row col-md-3">
                    <label for="end_date">End Date</label>
                    <input class="form-control" type="date" name="end_date" id="end_date"
                           value='<?= date('Y-m-d');?>'
                           min="2019-01-01">
                </div>
                <div class="row m-3 col-md-3">
                    <label for="product">Products</label>
                    <select class="form-control" name="product" id="product">
                        <option value="all" selected>All products</option>
                        @foreach($products as $product)}
                        <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row col-md-3 m-3" id="min_product_quantity">
                </div>
            </div>

            <button class="btn btn-primary">Search</button>
        </form>

    </div>
    @isset($result)
        <div class="row mb-2"><strong>Filter:</strong>{{old('product')}}</div>
        <div class="row col-md-10 border-bottom mb-2">
            <h4 class="col-md-3 d-inline-block">Invoice number</h4>
            <h4 class="col-md-3 d-inline-block">Invoice date</h4>
        </div>
        @foreach($result as $item)
            <div class="row border-bottom col-md-10 mb-2">
                <p class="col-md-3 ">
                    <a class="btn btn-info" href="{{route('invoice.show', [$item->number])}}">{{$item->number}}</a>
                </p>
                <p class=" col-md-3"><?= date('Y-m-d', strtotime($item->created_at))?> </p>
            </div>
        @endforeach
    @endisset
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#product').on('change', function () {

            if ($('#product').children("option:selected").val() != 'all') {
                $('#min_product_quantity')
                    .empty()
                    .append(
                        '  <label for="end_date">Min Product quantity</label>\n' +
                        '  <input class="form-control" type="number" name="min_product_quantity"\n' +
                        '  value="0" min="0">'
                    );
            } else {
                $('#min_product_quantity').empty();
            }
        });
    });
</script>