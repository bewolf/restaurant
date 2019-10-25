@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1>Hello {{auth()->user()->name}}</h1>


    </div>
@endsection
