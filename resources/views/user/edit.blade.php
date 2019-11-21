@extends('layouts.app')

@section('content')

    <div class="row justify-content-center col-md-12">
        <h1 class="col-md-9 text-center">Change profile data</h1>
        <div class="col-md-7">
            <h3 class="py-4">
                Username: {{auth()->user()->username}}
            </h3>
            <form method="post" action="{{route('user.update', ['user' => auth()->id() ])}}">
                @csrf
                @method('patch')


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name" required
                           value="{{auth()->user()->name}}">
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                           required value="{{auth()->user()->email}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
    <div class="row justify-content-center col-md-12">
        <h1 class="col-md-9 text-center py-4">Change password</h1>
        <div class="col-md-7">

            <form method="post" action="{{ route('password-change') }}" autocomplete="off">
                @csrf
                @method('put')

                <div class="pl-lg-4">
                    <div class="form-group">
                        <label class="form-control-label"
                               for="input-current-password">Current Password</label>
                        <input type="password" name="old_password" id="input-current-password"
                               class="form-control form-control-alternative"
                               placeholder="Current Password" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-password">New Password</label>
                        <input type="password" name="password" id="input-password"
                               class="form-control form-control-alternative"
                               placeholder="New Password" required>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"
                               for="input-password-confirmation">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="input-password-confirmation"
                               class="form-control form-control-alternative"
                               placeholder="Confirm New Password" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">Change password</button>
                    </div>
                </div>
            </form>
            <div class="btn-block py-4 ">
                <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
            </div>
        </div>
    </div>
@endsection