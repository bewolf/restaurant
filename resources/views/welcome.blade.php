@extends('layouts.app')

@section('content')

    @if(!$have_registered_manager)
        @include('layouts.create_first_manager')
    @else
        @include('auth.login')
    @endif
@endsection
