<?php
if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */
Route::resource('/', 'MarketController');
Route::get('product/{id}/edit', 'MarketController@edit');
Route::put('product/{id}', 'MarketController@update');

// route to process the form
Route::post('/login', array('uses' => 'LoginController@doLogin'));

Route::get('/logout', array('uses' => 'LoginController@doLogout'));

// ------------  Register Choose Job --------------------------
Route::resource('/register', 'RegisterController');
// ------------  Confirm to Regsiter Job Admin --------------------------
Route::post('/register/confirm_register', array('uses' => 'RegisterController@confirm_register'));
Route::get('register/confirm_register/checkUser/{username}', array('uses' => 'RegisterController@checkUser'));
// ----------------------------------------------

Route::resource('profile', 'AdminController');

