@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mb-4">
        <h1>Product types</h1>
    </div>
    <div class="row float-left mr-4 ml-4">
        <form action="{{route('product-types.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="create_product_type">Create Product Type</label>
                <input type="text" id="create_product_type" name="product_type" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Create">
            </div>
        </form>
    </div>
    <div class="row">
        <table>
            <thead>
            <tr class="row mb-2 ">
                <th class="col-md-4">Product Type</th>
                <th class="col-md-4">Edit</th>
                <th class="col-md-2">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($product_types as $item)
                <tr class="row border-bottom mb-2">
                    <td class="col-md-4" id="product_type_info">{{$item->type}}</td>
                    <td class="change_product_type_forms col-md-4">
                        <form method="post"
                              action="{{route('product-types.update', $item)}}"
                              id="{{$item->id}}" style="display: none">
                            @csrf
                            @method('patch')
                            <input name="product_type"
                                   class="form-control float-left pl-0 pr-0 text-center"
                                   type="text"
                                   value="{{$item->type}}">
                            <input class="form-control btn btn-success" type="submit"
                                   value="Set">
                        </form>
                        <button class="btn btn-info"
                                onclick="showUpdateProductTypeForm({{ $item->id}})">
                            Change
                        </button>
                    </td>
                    <td class="delete_product_type col-md-2">
                        <form action="{{route('product-types.destroy', $item)}}" method="post">
                            @csrf
                            @method('delete')

                            <input type="submit"
                                   class="btn btn-danger"
                                   value="Delete"
                                   onclick="confirm('Are you sure?')">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{$product_types->links()}}


@endsection

<script>
    function showUpdateProductTypeForm(id) {

        document.getElementById(id).nextElementSibling.style.display = 'none';

        document.getElementById(id).style.display = 'block';
    }
</script>