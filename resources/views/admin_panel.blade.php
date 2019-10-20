@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-4">Admin panel</h1>
    </div>
    <div class="row">
        <ul>
            <h3>User operations</h3>
            <li><a href="#">Create user</a></li>
            <li><a href="#">Edit user</a></li>
        </ul>
    </div>
    <div class="row">
        <h3>Statistics</h3>
        <ul>
            <li><a href="#">Daily</a></li>
            <li><a href="#">Period</a></li>
            <li><a href="#">Per user</a></li>
        </ul>
    </div>
    <div class="row">
        <h3>Warehouse</h3>
        <ul>
            <li>Check products</li>
            <li>Import</li>

        </ul>
    </div>
@endsection
