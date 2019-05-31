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

Route::get('/', function () {
    return redirect('/properties');
});

Route::post('/properties/{slug}/comment', 'CommentController@store');


Route::get('/properties', 'PropertiesController@index');
Route::get('/properties/create', 'PropertiesController@create');
Route::post('/properties/create', 'PropertiesController@store');
Route::patch('/properties/{id}', 'PropertiesController@update');
Route::delete('/properties/{id}', 'PropertiesController@destroy');

Route::get('/properties/{slug}', 'PropertiesController@show')->where('slug', '[\w\d\-\_]+');
Route::get('/properties/{slug}/edit', 'PropertiesController@edit')->where('slug', '[\w\d\-\_]+');



//Route::prefix('admin')->group(function () {
//
//    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
//    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
//
//});

//Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


