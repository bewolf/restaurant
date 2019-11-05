@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Workers</h1>
        <div class="col-md-9 py-3">
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>Change position</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as  $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->roles->pluck('name')[0] }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <select class="form-control" name="position" id="">
                                <option value="1" {{ $user->roles->pluck('name')[0]=="user" ? "selected" : ""}}>
                                    User
                                </option>
                                <option value="2" {{ $user->roles->pluck('name')[0]=="shift_manager" ? "selected" : ""}}>
                                    Shift Manager
                                </option>
                                <option value="3" {{ $user->roles->pluck('name')[0]=="manager" ? "selected" : ""}}>
                                    Manager
                                </option>
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
        </div>
    </div>
@endsection