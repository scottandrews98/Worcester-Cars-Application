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

// Individual Car
Route::get('/car/{id}', 'CarController@index')->name('car');

// Logged In Required Pages
Route::get('/user', 'LoggedIn\LoggedInUserController@index')->name('user');

Route::post('/admin', 'LoggedIn\LoggedInAdminController@store');
Route::get('/admin', 'LoggedIn\LoggedInAdminController@index')->name('admin');
Route::get('/admin/edit/{id}', 'LoggedIn\LoggedInAdminController@loadEdit')->name('editCar');
Route::post('/admin/edit/{id}', 'LoggedIn\LoggedInAdminController@saveEdit');
Route::get('/settings', 'LoggedIn\SettingsController@index')->name('settings');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Post Requests
Route::post('/contact', 'ContactController@store');
Route::post('/car', 'CarController@like');