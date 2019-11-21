@extends('layouts.app')

@section('content')
    <h1 class="col-md-9 text-center">Create food</h1>

    <div class="row col-md-10">

        <form method="post" action="{{route('food.store')}}">
            @csrf

            <div class="form-group " id="food_form_input_fields">

                <div class="form-group col-md-4 pl-0 float-none ">
                    <label for="name">Food name</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name') }}"
                           placeholder="Food name"
                           required>
                </div>
                <div class="form-group col-md-4 float-left pl-0 pr-0 pb-0">
                    <label for="product_name">Product name</label>
                </div>
                <div class="form-group col-md-2 float-left pl-0 pr-0">
                    <label for="name">Unit</label>
                </div>
                <div class="form-group col-md-2 float-left pl-0 pr-0">
                    <label for="name">Quantity</label>
                </div>

                <div class="col-md-12 d-bloc pl-0" id="row">
                    <div class="col-md-4 float-left pl-0 pr-3">
                        <select class="form-control" id="product_1" name="food_products[]">
                            <option disabled selected>Select product</option>
                            @foreach($products as $product => $unit)
                                <option value="{{$product}}">{{$product}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 float-left pl-0 pr-3">
                        <input type="text" class="form-control" id="unit_1" disabled value="">
                    </div>
                    <div class="col-md-2 float-left pl-0 pr-0">
                        <input type="text" id="quantity" name="quantity[]" class="form-control"
                               placeholder="Quantity"
                               required>
                    </div>

                    <div class="form-group col-md-1 float-left pr-0 mt-1 button-submitting">
                        <button type="button" class="btn" id="add" name="add">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pl-0 d-block pt-4">
                <button type="submit" class="btn btn-primary">Create food</button>
            </div>

        </form>
        <div class="col-md-4 pl-0 mt-4 d-block">
            <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to Home</a>
        </div>
    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        let i = 1;

        $('body').on('click', '#add', function () {
            i++;
            $('#food_form_input_fields').append(
                '<div class="col-md-12 d-inline-block pl-0" id="row' + i + '">' +
                    '<div class="form-group col-md-4 float-left pr-3 pl-0">' +
                        ' <select class="form-control" id="product_' + i + '" name="food_products[]">' +
                            '<option disabled selected>Select product</option>' +
                            '@foreach($products as $product => $key)' +
                                '<option value="{{$product}}">{{$product}}</option>' +
                            '@endforeach' +
                        '</select>' +
                    '</div>' +
                    '<div class="form-group col-md-2 float-left pl-0 pr-3">' +
                        ' <input type="text" class="form-control" id="unit_' + i +'" disabled value="">' +
                    '</div>' +
                    '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
                        '<input type="text" id="quantity" name="quantity[]" class="form-control"placeholder="Quantity"required>' +
                    '</div>' +
                    '<div class="form-group col-md-1 float-left pr-0  pt-1 ">' +
                        '<button type="button" class="btn" id="add" name="add"><i class="fas fa-plus"></i></button>' +
                    '</div>' +
                '</div>');

            $("#row > div:nth-child(4)")
                .remove();
            $("#row")
                .append('<div class="form-group col-md-1 float-left pr-0 mt-1"><button type="button" class="btn" id="remove" name="add"><i class="fas fa-minus"></i></button></div>');

            $("#row" + (i - 1) + "> div:nth-child(4)").remove();
            $("#row" + (i - 1)).append('<div class="form-group col-md-1 float-left pr-0  pt-1 "><button type="button" class="btn" id="remove" name="add"><i class="fas fa-minus"></i></button></div>')

            $('#product_1').change( function () {
                let firstProduct = $('#product_1').children("option:selected").text();
                console.log(products);

                $('#unit_1').attr('value', firstProduct);
            });
            $('#product_'+ i).change( function () {
                let product = $('#product_' +i).children("option:selected").text();
                $('#unit_' + i).attr('value', product);
            });
        });
        $('#food_form_input_fields').on('click', '#remove', function () {
            $(this).parents().eq(1).remove();
        });
    });

</script>