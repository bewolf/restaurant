@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="py-4">Hello {{auth()->user()->name}}</h1>
    </div>

    @include('session_alerts.alerts')


    @canany(['user', 'waiter', 'bartender', 'cook'])
        @include('layouts.workers_layout')
    @endcanany

@endsection
