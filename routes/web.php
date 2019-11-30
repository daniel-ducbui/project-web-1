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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');

/// HomeController
///
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::post('/home', 'HomeController@store')->name('post.store')->middleware('auth');

Route::get('/home/{post_id}', 'HomeController@destroy')->name('post.delete')->middleware('auth');;

Route::post('/home/post/edit', 'HomeController@edit')->name('post.edit')->middleware('auth'); // Pending
///
/// End HomeController


/// UsersController
///
Route::get('/profile/{user_name}/{user_id}', 'UsersController@userProfile')->name('user.profile')->middleware(['auth', 'verified']);

Route::get('/profile-details', 'UsersController@userInformation')->name('user.information')->middleware(['auth', 'verified']);

Route::post('/update-profile-details', 'UsersController@update')->name('user.update')->middleware(['auth', 'verified']);
///
/// End UsersController


/// Change password
///
Route::get('change-password', 'ChangePasswordController@index')->middleware(['auth', 'verified']);

Route::post('change-password', 'ChangePasswordController@store')->name('password.change')->middleware(['auth', 'verified']);
///
/// End change password
