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

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);


// All routes that needs a logged in user

Route::group(['middleware' => 'auth'], function () {

    // Route::resourse('user', 'UserController');

    Route::get('/home', 'HomeController@index')->name('home');
});
// Manager routes
Route::group(['middleware' => ['auth', 'manager']], function () {
    Route::get('/admin_panel', function () {
        return view('admin_panel');
    })->name('admin_panel');

    Route::resource('user', 'UserController');
});

// All routes that need no authentication

Route::get('/', function () {
    return view('welcome');
})->name('index')->middleware('guest');
