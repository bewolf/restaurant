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

// All routes that need no authentication

Route::get('/', 'GuestController@index')->middleware('guest')->name('index');

Route::post('/', 'GuestController@store')->middleware('guest')->name('store');



// All routes that needs a logged in user

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::patch('/update-roles', 'UserController@updateRoles')->name('update-roles');

    Route::get('/ex-workers', 'UserController@exWorkers')->name('ex-workers');

    Route::put('user/', 'UserController@changePassword')->name('password-change');

    Route::resource('user', 'UserController');

    Route::resource('invoice', 'InvoiceController');

    Route::resource('products', 'ProductController');

    Route::resource('food', 'FoodController');
});