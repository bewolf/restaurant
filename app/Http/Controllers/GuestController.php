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
        $have_registered_manager = DB::table('users_roles')->where('role_id', 3)->exists();

        return view('welcome', compact('have_registered_manager'));
    }

    public function store(FirstManagerStoreRequest $request)
    {

        $request['password'] = \Hash::make($request['password']);
        $manager_role = 3;
        $shift_manager_role = 2;
        $user = User::create($request->all());

        UsersRoles::insert([
            'user_id' => $user->id,
            'role_id' => $manager_role,
        ]);
        UsersRoles::insert([
            'user_id' => $user->id,
            'role_id' => $shift_manager_role,
        ]);

        return redirect()->route('index')->with('success', 'Successful created manager');
    }
}
