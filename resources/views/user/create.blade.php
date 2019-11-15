@extends('layouts.app')

@section('content')

    @can('manager')
        <div class="row justify-content-center ">

            <h1 class="col-md-12 text-center">Hire worker</h1>

            <div class="col-md-6">

                <form method="post" action="{{route('user.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" required
                               value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                               required value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <p>Permissions</p>
                        @foreach($roles as $key => $role)
                            <div class="form-control">
                                <input type="checkbox" value="{{$key + 1}}" name="role[]" id="{{$role}}">
                                <label for="{{$role}}"> {{$role}}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to Home</a>

            </div>
        </div>
    @endcan
@endsection