@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Workers</h1>
        <div class="col-md-12 py-3">
            <div id="workersTable" class="py-2">
                <div class="row py-2 text-center sticky-top ">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-2">Username</div>
                    <div class="col-md-2">Email</div>
                    <div class="col-md-2">Permissions</div>
                    <div class="col-md-2">Change permissions</div>
                    <div class="col-md-2">Worker Action</div>
                </div>
                @foreach($users as $user)
                    <div class="row pt-2 border border-top-0 border-left-0 border-right-0 border-info text-center">
                        <div class="col-md-2">{{ $user->name }}</div>
                        <div class="col-md-2 username">{{ $user->username }}</div>
                        <div class="col-md-2">{{ $user->email }}</div>
                        <div class="col-md-2">
                            {{implode(' | ', $user->roles->pluck('name')->toArray() )}}
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="#" class="btn btn-info permissionsChange"
                               onclick="showRolesForm({{ $user->id }})">Change</a>
                        </div>
                        <div class="col-md-2 text-center">

                            <form method="post" action="{{route('user.destroy', $user)}}">
                                @method('delete')
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Fire"
                                       onclick="return confirm('Are you sure?')">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 text-left roles-form" id="{{$user->id}}" style="display: none">
                        <form method="post" action="{{route('update-roles',  ['user' => $user->id])}}">
                            @csrf
                            @method("patch")
                            <div class="form-group">
                                    <p>Permissions</p>
                                    @foreach($roles as $role)
                                    <div class="form-control">
                                        <input type="checkbox" value="{{ $role->id }}" name="roles[]" id="{{ $role->name}}{{$user->id}}" @if(in_array($role->name, $user->roles->pluck("name")->toArray())) checked @endif>
                                        <label class="pl-2" for="{{ $role->name }}{{$user->id}}">{{ $role->name }}</label>
                                    </div>
                                    @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary"> Submit </button>
                            <span class=" btn close" onclick="hideRolesForm({{ $user->id }})"> Close </span>
                
                        </form>
                    </div>

                @endforeach
                {{ $users->links() }}

            </div>
            <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
            <a class="btn btn-secondary" href="{{route('ex-workers')}}">Ex workers</a>
        </div>
    </div>
@endsection

<script>
    function showRolesForm(id) {

        Array.from(document.getElementsByClassName('roles-form')).forEach((e) => {
            e.style.display = 'none'
        });

        document.getElementById(id).style.display = 'block';
    }

    function hideRolesForm(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
