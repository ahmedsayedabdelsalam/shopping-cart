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

Route::get('/', 'ProductsController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::get('/user/profile', 'UsersController@profile')->name('profile');
    Route::get('/logout', 'UsersController@logout');

    Route::get('checkout', 'ProductsController@checkoutView');
    Route::post('checkout', 'ProductsController@checkout');
});

Route::middleware('guest')->group(function() {
    Route::get('/register', 'UsersController@registerForm');
    Route::post('/register', 'UsersController@register');
    Route::get('/signin', 'UsersController@signinForm')->name('login');
    Route::post('/signin', 'UsersController@signin');
});

Route::get('shopping-cart/{id}', 'ProductsController@shoppingCart');
Route::get('shopping-cart', 'ProductsController@shoppingCartView');
Route::get('reduce/{id}', 'ProductsController@reduceItem');
Route::get('remove/{id}', 'ProductsController@removeItem');


Route::get('admin/dashbord', 'AdminController@index')->name('dashbord')->middleware('auth', 'admin');


Route::resource('item', "ItemsController");


