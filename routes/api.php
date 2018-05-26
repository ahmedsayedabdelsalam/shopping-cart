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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');
Route::post('logout', 'API\AuthController@logout');
Route::get('users', 'API\AuthController@users');
Route::get('roles', 'API\AuthController@roles');
Route::get('/profile','API\AuthController@profile');
Route::apiResource('/products','API\ProductController');
Route::group(['prefix' => 'products'], function() {
    Route::post('/{id}/addItem','API\OrderController@addItem');
    Route::delete('/{id}/removeItem','API\OrderController@removeItem');
    Route::post('/removeAll','API\OrderController@removeAll');
});