<div class="row justify-content-center ">

    <h1 class="col-md-12 text-center">Create first manager</h1>

    <div class="col-md-6">
        @include('session_alerts.alerts')
        <form method="post" action="{{route('store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required
                       value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="Username"
                       required value="{{old('username')}}">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com"
                       required value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                       required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control"
                       id="password_confirmation"
                       placeholder="Confirm Password"
                       required>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a class="btn btn-primary mt-2" href="{{route('home')}}">Back to Home</a>

    </div>
</div>