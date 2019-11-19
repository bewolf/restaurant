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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public static function addUser($data)
    {
        $password = Str::random(rand(10, 15));
        self::transliterate($data['name']);

        if (!self::createUsername($data['name'])) {
            return redirect()->route('user.create')->with('error', 'Need at least two names');
        }
        $data['username'] = self::createUsername($data['name']);
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

        return redirect()->route('user.create')->with('success', 'Successful created user')->withInput();
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

    private static function transliterate($textcyr = null, $textlat = null)
    {
        $cyr = array(
            'ж', 'ч', 'щ', 'ш', 'ю', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
            'Ж', 'Ч', 'Щ', 'Ш', 'Ю', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');
        $lat = array(
            'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
            'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');
        if ($textcyr) return str_replace($cyr, $lat, $textcyr);
        else if ($textlat) return str_replace($lat, $cyr, $textlat);
        else return null;
    }

    private static function createUsername($data)
    {
        if (str_word_count($data) < 2) {
            return false;
        }
        $fistName = strtolower(substr($data, 0, 1));
        $lastName = strtolower(explode(' ', $data)[1]);
        $username = $fistName . $lastName . (User::max('id') + 1);

        return $username;
    }
}
