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

Route::middleware('auth', 'verified')->group(function () {
    /// UsersController
    ///
    Route::get('/profile/{user_name}s/{user_id}', 'UsersController@userProfile')->name('user.profile');

    Route::get('/profile-details', 'UsersController@userInformation')->name('user.information');

    Route::post('/update-profile-details', 'UsersController@update')->name('user.update');
    ///
    /// End UsersController


    /// Change password
    ///
    Route::get('change-password', 'ChangePasswordController@index');

    Route::post('change-password', 'ChangePasswordController@store')->name('password.change');
    ///
    /// End change password
});
/// Friendships
///
Route::get('/profile/{user_name}/{recipient_id}/request', 'FriendshipsController@send')->name('request.send');

Route::get('/profile/{user_name}/{sender_id}/accept', 'FriendshipsController@accept')->name('request.accept');

Route::get('/profile/{user_name}/{sender_id}/deny', 'FriendshipsController@deny')->name('request.deny');

Route::get('/profile/{user_name}/{sender_id}/unfriend', 'FriendshipsController@unfriend')->name('request.unfriend');
///
/// End Friendships
