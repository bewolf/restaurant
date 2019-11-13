@extends('layouts.app')

@section('content')
    <h1 class="text-center py-4"> Ex workers</h1>
    <table class="table table-bordered">
        <tr class="thead-dark text-center">
            <th>Name</th>
            <th>Permissions</th>
            <th>Hired</th>
            <th>Fired</th>
        </tr>
        @foreach($users as $user)
            <tr class="text-center">
                <td>{{$user->name}}</td>
                <td> {{implode(' | ', $user->roles->pluck('name')->toArray() )}}</td>
                <td>{{$user->created_at->format('d.M.Y.')}}</td>
                <td>{{$user->deleted_at->format('d.M.Y.')}}</td>
            </tr>
        @endforeach

    </table>
    {{ $users->links() }}
    <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
    <a class="btn btn-secondary" href="{{route('user.index')}}">Back to Workers</a>
@endsection
