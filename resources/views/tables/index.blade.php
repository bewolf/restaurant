@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mb-4"><h1>Tables</h1></div>
    <div class="row col-md-4 float-left">
        <form action="{{route('table.store')}}" method="post">
            @csrf

            <div class="form-group">
                <label for="number_of_tables">Set number of tables</label>
                <input id="number_of_tables" class="form-control" type="number" step="1" value="{{$tables}}"
                       name="number_of_tables">
            </div>
            <div class="form-group">

                <input type="submit" class="btn btn-success">
            </div>
        </form>
    </div>
    <div class="row">
        <p>You have <strong>{{$tables}}</strong> tables</p>
    </div>

@endsection