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
    return view('home');
});

Auth::routes();

// Top level pages routes
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/cars', 'CarsController@index')->name('cars');
Route::get('/contact', 'ContactController@index')->name('contact');


// Logged In Required Pages
Route::get('/user', 'LoggedIn\LoggedInUserController@index')->name('user');

Route::get('/admin', 'LoggedIn\LoggedInAdminController@index')->name('admin');
Route::post('/admin', 'LoggedIn\LoggedInAdminController@store');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');