@extends('layouts.app')

@section('content')
    @can('manager')
        @include('admin_panel')
    @endcan

    {{--@if(auth()->user()->roles == 'manager')--}}

        {{--@include('admin_panel')--}}
    {{--@endif--}}
@endsection
