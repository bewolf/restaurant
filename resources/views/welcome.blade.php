@extends('layouts.app')

@section('content')

    @if(!$haveRegisteredManager)
        @include('layouts.create_first_manager')
    @else
        @include('auth.login')
    @endif
@endsection
