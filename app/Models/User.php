<?php

namespace App\Models;

use App\Mail\UserCreated;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Monolog\Handler\IFTTTHandler;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function addUser($data)
    {
        $password = Str::random(rand(10, 15));
        if (self::isBulgarian($data['name'])) {
        } else {
            $data['username'] = self::createUsername($data['name']);
        }

        $data['password'] = Hash::make($password);

        $user = User::create($data);
        $roles = $data['role'];

        for ($i = 0; $i < count($roles); $i++) {
            UsersRoles::insert([
                'user_id' => $user->id,
                'role_id' => $roles[$i],
            ]);
        }
        self::sendMail($data, $password);

        return redirect()->route('user.create')->with('success', 'Successful created user');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    private static function sendMail($data, $password)
    {
        $userMail = [
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => $password,
        ];
        Mail::to($data['email'])->send(new UserCreated($userMail));
    }

    private static function isBulgarian($text)
    {
        return preg_match('/[А-Яа-я]/u', $text);
    }

    private static function createUsername($data)
    {
        $fistName = strtolower(substr($data, 0, 1));
        $lastName = strtolower(explode(' ', $data)[1]);
        $username = $fistName . $lastName . (User::max('id') + 1);

        return $username;
    }

}
