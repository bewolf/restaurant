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

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('user', 'UserController');

});
// Manager routes
Route::group(['middleware' => ['auth', 'manager']], function () {


    Route::resource('invoice', 'InvoiceController');

    Route::resource('product', 'ProductController');
});

// All routes that need no authentication

Route::get('/', 'GuestController@index')->name('index');
