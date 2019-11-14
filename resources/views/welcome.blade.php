@extends('layouts.app')

@section('content')
    @include('session_alerts.alerts')

    @if(!$haveRegisteredManager)
        @include('layouts.create_first_manager')
    @else
        @include('auth.login')
    @endif
@endsection
