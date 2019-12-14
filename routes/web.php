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

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    /// HomeController
    ///
    Route::get('/home', 'HomeController@index')->name('home');

    Route::post('/home', 'HomeController@store')->name('post.store');

    Route::get('/home/post/delete/{post_id}', 'HomeController@destroy')->name('post.delete');;

    Route::post('/home/post/edit', 'HomeController@edit')->name('post.edit'); // Pending

    Route::get('/home/post/like/{post_id}', 'LikesController@like')->name('like.like'); // Pending
    ///
    /// End HomeController

    /// Friendships
    ///
    Route::get('/profile/{user_name}/{recipient_id}/request', 'FriendshipsController@send')->name('request.send');

    Route::get('/profile/{user_name}/{sender_id}/accept', 'FriendshipsController@accept')->name('request.accept');

    Route::get('/profile/{user_name}/{sender_id}/deny', 'FriendshipsController@deny')->name('request.deny');

    Route::get('/profile/{user_name}/{this_user}/unfriend', 'FriendshipsController@unfriend')->name('request.unfriend');

    Route::get('/profile/{user_name}/{recipient_id}/cancel', 'FriendshipsController@cancel')->name('request.cancel');

    Route::get('/profile/{user_name}/{recipient_id}/follow', 'FriendshipsController@follow')->name('request.follow');

    Route::get('/profile/{user_name}/{recipient_id}/unfollow', 'FriendshipsController@unfollow')->name('request.unfollow');
    ///
    /// End Friendships
});


Route::middleware('auth', 'verified')->group(function () {
    /// UsersController
    ///
    Route::get('/profile/{user_name}/{user_id}', 'UsersController@userProfile')->name('user.profile');

    Route::get('/profile/details', 'UsersController@userInformation')->name('user.information');

    Route::post('/profile/details/update', 'UsersController@update')->name('user.update');
    ///
    /// End UsersController


    /// Change password
    ///
    Route::get('/password/change', 'ChangePasswordController@index');

    Route::post('/password/change', 'ChangePasswordController@store')->name('password.change');
    ///
    /// End change password
});
