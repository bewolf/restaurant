@extends('layouts.app')

@section('content')

    @can('manager')
        @include('manager.index')
    @endcan
    @can('user')
        <h1>User {{auth()->user()->name}}</h1>
    @endcan


@endsection
