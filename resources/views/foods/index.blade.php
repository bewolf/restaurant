@extends('layouts.app')
@section('content')

    <div class="row justify-content-center mb-3"><h1>Foods</h1></div>
    <div class="row col-md-10 py-3">
        <table class="table text-center">
            <tr>
                <th scope="col">Foods</th>
                <th scope="col">Sell price</th>
                <th scope="col">Date</th>
                <th scope="col">View ingredients</th>
                <th scope="col">Edit recipe</th>
                <th scope="col">Remove recipe</th>
            </tr>
            @foreach($foods as $food)
                <tr>
                    <td>{{$food->name}}</td>
                    <td>{{$food->sell_price}}</td>
                    <td>{{$food->created_at->toDateString()}}</td>
                    <td><a class="btn btn-info" href="{{route('food.show', $food->id)}}">Show ingredients</a></td>
                    <td><a class="btn btn-secondary" href="{{route('food.edit', $food->id)}}">Edit</a></td>
                    <td>
                        <form method="post" action="{{route('food.destroy', $food->id)}}" onclick="return confirm('Are you sure?')">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $foods->links() }}

        <a class="btn btn-primary m-2" href="{{route('home')}}">Back to Home</a>
    </div>
@endsection
