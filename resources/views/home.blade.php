@extends('layouts.app')

@section('content')
    @can('manager')
        <h1>Manager!</h1>
    @endcan

    {{--@if(auth()->user()->roles == 'manager')--}}

        {{--@include('admin_panel')--}}
    {{--@endif--}}
@endsection
