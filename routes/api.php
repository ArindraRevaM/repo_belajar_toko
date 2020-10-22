<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

Route::group(['middleware' => ['api.superadmin']], function ()
{
	Route::delete('/customers/{id}', 'CustomersController@destroy');
	Route::delete('/product/{id}', 'ProductController@store');
	Route::delete('/orders/{id}', 'OrdersController@delete');
});

Route::group(['middleware' => ['api.admin']], function ()
{
	Route::post('/customers', 'CustomersController@store');
	Route::put('/customers/{id}', 'CustomersController@update');

	Route::post('/product', 'ProductController@store');
	Route::put('/product/{id}', 'ProductController@update');

	Route::post('/orders', 'OrdersController@store');
	Route::put('/orders/{id}', 'OrdersController@update');
});

Route::get('/customers', 'CustomersController@show');
Route::get('/customers/{id}', 'CustomersController@detail');

Route::get('/product', 'ProductController@show');
Route::get('/product/{id}', 'ProductController@detail');

Route::get('/orders', 'OrdersController@show');
Route::get('/orders/{id}', 'OrdersController@detail');
});
