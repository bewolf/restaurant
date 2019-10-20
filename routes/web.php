<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => false]);


// All routes that needs a logged in user

Route::group(['middleware' => 'auth'], function () {

    // Route::resourse('user', 'UserController');

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['middleware' => ['auth', 'manager']], function () {
    Route::get('/admin_panel', function () {
        if (auth()->user()->username == 'manager') {
            return view('admin_panel');
        }
        //Need refactor on next row
        return back();
    })->name('admin_panel');
});

// All routes that need no authentication

Route::get('/', function () {
    return view('welcome');
})->name('index')->middleware('guest');
