@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">

        <h1 class="col-md-12 text-center">Add invoice</h1>

        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="post" action="{{route('invoice.store')}}">
                @csrf

                <div id="invoice_form_input_fields">
                    <div class="form-group col-md-4 pl-0">
                        <label for="invoice_number">Invoice number</label>
                        <input type="text" id="invoice_number" name="invoice_number" class="form-control"
                               placeholder="Invoice number"
                               required>
                    </div>

                    <div class="form-group col-md-4 float-left pl-0">
                        <label for="name">Product name</label>
                        <input type="text" id="name" name="name[]" class="form-control" placeholder="Product name"
                               required>
                    </div>

                    <div class="form-group col-md-2 float-left pl-0 pr-0">
                        <label for="unit">Unit</label>
                        <select class="form-control" id="unit" name="unit[]">
                            <option disabled selected>Select unit</option>
                            <option value="kg">kg</option>
                            <option value="grams">grams</option>
                            <option value="qty.">qty.</option>
                            <option value="cm">cm</option>
                            <option value="liters">liters</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 float-left pl-0 pr-0">
                        <label for="quantity">Quantity</label>
                        <input type="text" id="quantity" name="quantity[]" class="form-control"
                               placeholder="Quantity"
                               required>
                    </div>
                    <div class="form-group col-md-2 float-left pl-0 pr-0">
                        <label for="price">Price</label>
                        <input type="text" id="price" name="price[]" class="form-control" placeholder="Price"
                               required>
                    </div>
                    <div class="form-group col-md-1 float-left pr-0 mt-4 pt-2 ">
                        <button type="button" class="btn" id="add" name="add">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-4 pl-0">
                    <button type="submit" class="btn btn-primary">Submit invoice</button>
                </div>
            </form>

            <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to admin panel</a>

        </div>

    </div>



@endsection
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var i = 1;

        $('#add').click(function () {
            i++;
            $('#invoice_form_input_fields').append('<div id="row' + i + '" class="form-group col-md-4 float-left pr-0 pl-0"><input type="text" id="name" name="name[]" class="form-control" placeholder="Product name"required></div><div class="form-group col-md-2 float-left pl-0 pr-0"><select class="form-control" id="unit" name="unit[]"><option disabled selected>Select unit</option><option value="kg">kg</option><option value="grams">grams</option><option value="qty.">qty.</option><option value="cm">cm</option><option value="liters">liters</option></select></div><div class="form-group col-md-2 float-left pl-0 pr-0"><input type="text" id="quantity" name="quantity[]" class="form-control"placeholder="Quantity"required></div><div class="form-group col-md-2 float-left pl-0 pr-0"><input type="text" id="price" name="price[]" class="form-control" placeholder="Price"required></div><div class="form-group col-md-1 float-left pr-0  pt-1 "><button type="button" class="btn" id="add" name="add"><i class="fas fa-plus"></i></button></div>');

        });
    });
</script>