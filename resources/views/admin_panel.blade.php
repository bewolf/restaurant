@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-4">Admin panel</h1>
    </div>
    <div class="row justify-content-center">
        <div id="user_panel" class="list-group col-md-3 border float-left ml-2">
            <h3 class="toast-header justify-content-center">User actions</h3>
            <a href="#" class="list-group-item list-group-item-action">Users</a>
            <a href="#" class="list-group-item list-group-item-action">Create User</a>
            <a href="#" class="list-group-item list-group-item-action">Edit User</a>
        </div>
        <div id="stats_panel" class="list-group col-md-3 border float-left ml-2">
            <h3 class="toast-header justify-content-center">Statistics</h3>
            <a href="#" class="list-group-item list-group-item-action">Daily</a>
            <a href="#" class="list-group-item list-group-item-action">Period</a>
            <a href="#" class="list-group-item list-group-item-action">Per user</a>
        </div>
        <div id="warehouse_panel" class="list-group col-md-3 border float-left ml-2">
            <h3 class="toast-header justify-content-center">Warehouse</h3>
            <a href="#" class="list-group-item list-group-item-action">Import</a>
            <a href="#" class="list-group-item list-group-item-action">Availability</a>
        </div>
    </div>
@endsection
