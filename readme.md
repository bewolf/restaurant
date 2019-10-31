## About Restaurant

Restaurant is a web application for any type of retail outlets in this industry. Restaurant, fast food, night club, snack bar, tavern and more. Hire and fire <b>Currently under construction. v.0 :)</b>

## Security Vulnerabilities

If you discover a security vulnerability within Restaurant, please send an e-mail to us Georgi Valchev via [valchevgd@gmail.com](mailto:valchevgd@gmail.com) or Georgi Matsov via [matsov@gmail.com](mailto:matsov@gmail.com). We will do our best to fix all security vulnerabilities.

## License

The Restaurant is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Instalation
1. In file Illuminate\Foundation\Auth\AuthenticatesUsers
    > function username replace from return 'email' to return 'username'

Open command prompt at program directory and type:

> php artisan tinker

> $user = new User;

> $user->name = 'name';

> $user->username = manager;

> $user->password = Hash::make('your password');

> $user->email = 'email@example.com';

> $user->save();

Exit from command prompt and enter with your manager account to start work.