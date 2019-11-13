@extends('layouts.app')

@section('content')
    @include('session_alerts.alerts')
    <div class="row justify-content-center">
        <h1 class="col-md-6 text-center">Workers</h1>
        <div class="col-md-12 py-3">
            <div id="users" class="py-2">
                <div class="row py-2 text-center sticky-top">
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
                            <a href="#" class="btn btn-info permissionsChange" id="{{$user->id}}"
                               onclick="rolesChanger( {{$user->roles->pluck('name')}},{{ $user->id}} )">Change</a>
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

                @endforeach
                {{ $users->links() }}

            </div>
            <a class="btn btn-primary" href="{{route('home')}}">Back to Home</a>
            <a class="btn btn-secondary" href="{{route('ex-workers')}}">Ex workers</a>
        </div>
    </div>
@endsection

<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">

</script>
<script>
    function rolesChanger(currentRoles, id) {

        console.log(currentRoles);

        if ($("#permissionsForm").length > 0) {
            $('#permissionsForm').remove();
        }
        $("#" + id).parents(':eq(1)').append(
            '<div class="col-md-6 text-left" id="permissionsForm">' +
                '<form method="post" action="{{route('update-roles',  ['user' => $user->id])}}">' +
                    '@csrf' +
                    '@method("patch")' +
                    ' <div class="form-group">' +
                        '<p>Permissions</p>' +
                        '@foreach($roles as $key => $role)' +
                        '<div class="form-control">' +
                            '<input type="checkbox" value="{{$key + 1}}" name="roles[]" id="{{$role}}">' +
                            '<label class="pl-2" for="{{$role}}">{{$role}}</label>' +
                        '</div>' +
                        '@endforeach' +
                    '</div>' +
                    '<button type="submit" class="btn btn-primary"> Submit </button>' +
                    '<button type="submit" class="close"> Close </button>' +
                '</form>' +
            '</div>');

        $(document).on("click", "button.close", function () {
            $(this).parents(':eq(1)').remove();
        });
    }

</script>