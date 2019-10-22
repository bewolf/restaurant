@extends('layouts.app')

@section('content')
    <h1>Users</h1>
    <div class="col-md-9 py-3">
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as  $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{route('admin_panel')}}">Back</a>
    </div>

@endsection