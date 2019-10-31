@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">

        <h1 class="col-md-12 text-center">Add invoice</h1>

        <div class="col-md-6">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="post" action="{{route('invoice.store')}}">
                @csrf
                <table class="border">
                    <tr class="py-2">
                        <th>Invoice number</th>
                        <td>
                            <input type="text" id="number" name="number" class="form-control"
                                   placeholder="Invoice number"
                                   required>
                        </td>
                    </tr>
                    <tr>
                        <th>Product name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit price</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Product name"
                                       required>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select class="form-control" id="unit" name="unit">
                                    <option disabled selected>Select unit</option>
                                    <option value="kg">kg</option>
                                    <option value="grams">grams</option>
                                    <option value="qty.">qty.</option>
                                    <option value="cm">cm</option>
                                    <option value="liters">liters</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="quantity" name="quantity" class="form-control"
                                       placeholder="Quantity"
                                       required>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" id="price" name="price" class="form-control" placeholder="Price"
                                       required>
                            </div>
                        </td>
                    </tr>
                </table>
                <a class="btn btn-secondary" href="#">Add line</a>

                <button type="submit" class="btn btn-primary">Submit invoice</button>
            </form>


            <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to admin panel</a>

        </div>

    </div>

@endsection