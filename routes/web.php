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

    Route::get('stats', 'UserController@stats')->name('stats');

    Route::resource('user', 'UserController');

    Route::resource('invoice', 'InvoiceController');

    Route::get('invoice-statistics', 'InvoiceController@statistics')->name('invoice-statistics');

    Route::resource('products', 'ProductController');

    Route::resource('product-types', 'ProductTypesController');

    Route::resource('table', 'TablesController');

    Route::get('/order/create/{table}', 'OrderController@create')->name('order.create');
    Route::post('/order/store/{order_id}', 'OrderController@process')->name('order.process');
    Route::get('/order/close/{order_id}', 'OrderController@close')->name('order.close');
    Route::get('/order/{order_id}', 'OrderController@show')->name('order.show');

    Route::get('/statistics', 'StatisticsController@index')->name('statistics.index');
    Route::post('/statistics', 'StatisticsController@show')->name('statistics.show');
    Route::get('/statistics/today-orders', 'StatisticsController@todayOrders')->name('statistics.orders.today');
    Route::get('/statistics/custom-period-orders', 'StatisticsController@customPeriodOrders')->name('statistics.orders');
});
