@extends('layouts.app')

@section('content')

    <h1 class="col-md-10 text-center">Add invoice</h1>

    <div class="row col-md-10">

        <form method="post" action="{{route('invoice.store')}}">
            @csrf

            <div class="form-group " id="invoice_form_input_fields">

                <div class="form-group col-md-4 pl-0 float-none ">
                    <label for="number">Invoice number</label>
                    <input type="text" id="number" name="number" class="form-control" value="{{ old('number') }}"
                           placeholder="Invoice number"
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
                <div class="form-group col-md-2 float-left pl-0 pr-0">
                    <label for="name">Price per unit</label>
                </div>
                <div class="col-md-12 d-inline-bloc pl-0" id="row">
                    <div class="form-group col-md-4 float-left pl-0 pr-0">
                        <input type="text" id="product_name" name="product_name[]" class="form-control" value=""
                               placeholder="Product name"
                               required>
                    </div>

                    <div class="col-md-2 float-left pl-0 pr-0">
                        <select class="form-control" id="unit" name="unit[]">
                            <option disabled selected>Select unit</option>
                            <option value="kg">kg</option>
                            <option value="grams">grams</option>
                            <option value="qty.">qty.</option>
                            <option value="cm">cm</option>
                            <option value="liters">liters</option>
                        </select>
                    </div>
                    <div class="col-md-2 float-left pl-0 pr-0">
                        <input type="text" id="quantity" name="quantity[]" class="form-control"
                               placeholder="Quantity"
                               required>
                    </div>
                    <div class="form-group col-md-2 float-left pl-0 pr-0">
                        <input type="text" id="unit_price" name="unit_price[]" class="form-control" placeholder="Price"
                               required>
                    </div>
                    <div class="form-group col-md-1 float-left pr-0 mt-1 ">
                        <button type="button" class="btn" id="add" name="add">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pl-0 d-inline-block">
                <button type="submit" class="btn btn-primary">Submit invoice</button>
            </div>

        </form>
        <div class="col-md-10 pl-0">
            <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to Home</a>
        </div>

    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var i = 1;

        $('body').on('click', '#add', function () {
            i++;
            $('#invoice_form_input_fields').append('<div class="col-md-12 d-inline-block pl-0" id="row' + i + '">' +
                '<div class="form-group col-md-4 float-left pr-0 pl-0">' +
                    '<input type="text" id="product_name" name="product_name[]" class="form-control" placeholder="Product name"required>' +
                '</div>' +
                    '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
                        '<select class="form-control" id="unit" name="unit[]">' +
                            '<option disabled selected>Select unit</option>' +
                            '<option value="kg">kg</option>' +
                            '<option value="grams">grams</option>' +
                            '<option value="qty.">qty.</option>' +
                            '<option value="cm">cm</option>' +
                            '<option value="liters">liters</option>' +
                        '</select>' +
                    '</div>' +
                        '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
                            '<input type="text" id="quantity" name="quantity[]" class="form-control"placeholder="Quantity"required>' +
                        '</div>' +
                        '<div class="form-group col-md-2 float-left pl-0 pr-0">' +
                            '<input type="text" id="unit_price" name="unit_price[]" class="form-control" placeholder="Price"required></div>' +
                        '<div class="form-group col-md-1 float-left pr-0  pt-1 ">' +
                        '<button type="button" class="btn" id="add" name="add"><i class="fas fa-plus"></i></button>' +
                    '</div>' +
                '</div>');

            $("#row > div:nth-child(5)")
                .remove();
            $("#row")
                .append('<div class="form-group col-md-1 float-left pr-0 mt-1"><button type="button" class="btn" id="remove" name="add"><i class="fas fa-minus"></i></button></div>');

            $("#row" + (i - 1) + "> div:nth-child(5)")
                .remove();
            $("#row" + (i - 1))
                .append('<div class="form-group col-md-1 float-left pr-0  pt-1 "><button type="button" class="btn" id="remove" name="add"><i class="fas fa-minus"></i></button></div>')

        });
        $('#invoice_form_input_fields').on('click', '#remove', function () {
            $(this).parents().eq(1).remove();
        });
    });
</script>