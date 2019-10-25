@extends('layouts.app')

@section('content')
    <div class="row justify-content-center ">

        <h1 class="col-md-12 text-center">Hire worker</h1>

        <div class="col-md-6">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <form method="post" action="{{route('user.store')}}">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username" placeholder="Username"
                           required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                           required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                           required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                           placeholder="Confirm Password"
                           required>
                </div>
                <div class="form-group">
                    <label for="role">Position</label>
                    <select class="form-control" id="role" name="role">
                        <option disabled selected>Select position</option>
                        <option value="2">Shift Manager</option>
                        <option value="1">Waiter</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a class="btn btn-primary mt-2" href="{{route('admin_panel')}}">Back to admin panel</a>

        </div>

    </div>

@endsection