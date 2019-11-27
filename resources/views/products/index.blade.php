@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Warehouse</h1>
        <div class="col-md-9 py-3">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark text-center">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Avg. Price</th>
                    <th>Sell Price</th>
                    <th>Set Sell Price</th>
                    <th>Is a drink</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $key => $product)

                    <tr class="text-center">
                        <td>{{ $product->product_name }}</td>
                        <td @if($product->quantity < $minQuantity) class="alert-danger"
                            title='Please order'@endif>{{ $product->quantity }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->avg_price}}</td>
                        <td @if($product->sell_price <= $product->avg_price) class="text-danger"
                            title='Change sell price'@endif>{{ $product->sell_price}}</td>
                        <td class="change_sell_price_forms">
                            <form method="post" class="change_sell_price_forms mb-0"
                                  action="{{route('products.update', $product->product_name)}}"
                                  id="{{$product->id}}" style="display: none">
                                @csrf
                                @method('patch')
                                <input name="sell_price" class="form-control float-left col-md-6 pl-0 pr-0 text-center"
                                       type="number" step="0.01"
                                       value="{{$product->sell_price}}"
                                       title="Suggested price:{{round(($product->avg_price + $product->avg_price/3),2)}}">
                                <input class="form-control  btn btn-success col-md-4 pl-0 pr-0" type="submit"
                                       value="Set">
                            </form>

                            <button @if($product->sell_price <= $product->avg_price) class="btn btn-danger"
                                    @else class="btn btn-success"
                                    @endif
                                    onclick="showUpdatePriceForm({{ $product->id}})">
                                Change
                            </button>
                        </td>
                        <td>
                            <form method="post" action="{{route('isADrink', [ 'id' => $product->id])}}">
                                @csrf
                                @method('PATCH')
                                <input id="is_drink" name="is_drink" type="checkbox"
                                       onchange="this.form.submit()"
                                        {{$product->is_drink ? 'checked' : ''}}>
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

<script>
    function showUpdatePriceForm(id) {

        document.getElementById(id).nextElementSibling.style.display = 'none';

        document.getElementById(id).style.display = 'block';
    }

</script>