@component('mail::message')

    # Registered new user {!! $userMail['name']!!}

    Login details:
    Username: {!! $userMail['username']!!}
    Password: {!! $userMail['password']!!}

    After first login please change your password.



    @component('mail::button', ['url' => ''])
        Enter your account
    @endcomponent

    This is automatic generated message. We don't have information about your password.
    Please don't answer to this email.
    Thanks, G&G Restaurant.<br>
    {!!  config('app.name') !!}
@endcomponent
