@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
@if($errors->any())
    <div class="row">
        <div class="col-md-12">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="list-group">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{$error }}</strong>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif