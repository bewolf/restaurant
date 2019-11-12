<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

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
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $roles = $data['role'];
        for ($i = 0; $i < count($roles); $i++) {
            UsersRoles::insert([
                'user_id' => $user->id,
                'role_id' => $roles[$i],
            ]);
        }
        return redirect()->route('user.create')->with('success', 'Successful created user');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
}
