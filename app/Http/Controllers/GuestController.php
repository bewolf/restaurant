<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirstManagerStoreRequest;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UsersRoles;


class GuestController extends Controller
{
    public function index()
    {
        $haveRegisteredManager = DB::table('users_roles')->where('role_id', 3)->exists();

        return view('welcome', compact('haveRegisteredManager'));
    }

    public function store(FirstManagerStoreRequest $request)
    {
        $request['password'] = \Hash::make($request['password']);
        $managerRole = 3;
        $shift_managerRole = 2;
        $user = User::create($request->all());

        UsersRoles::insert([
            'user_id' => $user->id,
            'role_id' => $managerRole,
        ]);
        UsersRoles::insert([
            'user_id' => $user->id,
            'role_id' => $shift_managerRole,
        ]);

        return redirect()->route('index')->with('success', 'Successful created manager');

    }
}
