@extends('layouts.app')
@section('nav')
    @can('manager')
        @include('manager.nav')
    @endcan
    @can('shift_manager')
        @include('shift_manager.nav')
    @endcan
    @can('user')
        @include('worker.nav')
    @endcan

@endsection

@section('content')

    @can('manager')
        @include('manager.index')
    @endcan
    @can('shift_manager')
        @include('shift_manager.index')
    @endcan
    @can('user')
        @include('worker.index')
    @endcan

@endsection
