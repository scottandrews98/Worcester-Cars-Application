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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

// Top level pages routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/cars', 'CarsController@index')->name('cars');
Route::get('/contact', 'ContactController@index')->name('contact');

// Individual Car
Route::get('/car/{id}', 'CarController@index')->name('car');

// Logged In Required Pages
Route::get('/user', 'LoggedIn\LoggedInUserController@index')->name('user');
Route::get('/profile', 'LoggedIn\ProfileController@index')->name('profile');

Route::post('/admin/{type}/{id}', 'LoggedIn\LoggedInAdminController@store');
Route::get('/admin', 'LoggedIn\LoggedInAdminController@index')->name('admin');
Route::get('/admin/edit/{id}', 'LoggedIn\LoggedInAdminController@loadEdit')->name('editCar');
Route::post('/admin/edit/{id}', 'LoggedIn\LoggedInAdminController@saveEdit');
Route::post('/admin/delete', 'LoggedIn\LoggedInAdminController@deleteCar');
Route::get('/settings', 'LoggedIn\SettingsController@index')->name('settings');
Route::get('/viewStared/{id}', 'LoggedIn\SettingsController@loadStaredUser')->name('viewStared');
Route::get('/viewProfile/{id}', 'LoggedIn\SettingsController@loadUserProfile')->name('adminViewProfile');
Route::get('/viewMessage/{id}', 'LoggedIn\SettingsController@loadMessage')->name('adminViewMessage');
Route::post('/viewMessage', 'LoggedIn\SettingsController@sendMessage')->name('adminSendMessage');
Route::post('/deleteMessage', 'LoggedIn\SettingsController@deleteMessage')->name('adminDeleteMessage');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

// Post Requests
Route::post('/contact', 'ContactController@store');
Route::post('/car', 'CarController@like');
Route::post('/carCheck', 'CarController@likeCheck');
Route::post('/settings', 'LoggedIn\SettingsController@saveSettings');
Route::post('/admin/makeAndRemoveAdmins', 'LoggedIn\SettingsController@makeAndRemoveAdmins');
Route::post('/profile', 'LoggedIn\ProfileController@updateProfile');
Route::post('/profile/delete', 'LoggedIn\ProfileController@deleteProfile');
Route::post('/cars', 'CarsController@searchCars');
Route::post('/getCompareDetails', 'CarController@getCompareDetails');

// Google Single Sign In Routes
Route::get('/google/redirect', 'Auth\GoogleAuthController@redirectToProvider');
Route::get('/callback', 'Auth\GoogleAuthController@handleProviderCallback');