<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Post;
//use Hootlex\Friendships\Traits\Friendable;
use App\Traits\Friendable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'dob', 'profile_picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //======================== Functions to get posts attribute =========================
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
    //======================== End functions to get posts attribute =========================


//    //======================== Functions to get friends attribute =========================
//    // friendship that this user started
//    protected function friendsOfThisUser()
//    {
//        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
//            ->withPivot('status')
//            ->wherePivot('status', 'confirmed');
//    }
//
//    // friendship that this user was asked for
//    protected function thisUserFriendOf()
//    {
//        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
//            ->withPivot('status')
//            ->wherePivot('status', 'confirmed');
//    }
//
//    // accessor allowing you call $user->friends
//    public function getFriendsAttribute()
//    {
//        if (!array_key_exists('friends', $this->relations)) $this->loadFriends();
//        return $this->getRelation('friends');
//    }
//
//    protected function loadFriends()
//    {
//        if (!array_key_exists('friends', $this->relations)) {
//            $friends = $this->mergeFriends();
//            $this->setRelation('friends', $friends);
//        }
//    }
//
//    protected function mergeFriends()
//    {
//        if ($temp = $this->friendsOfThisUser)
//            return $temp->merge($this->thisUserFriendOf);
//        else
//            return $this->thisUserFriendOf;
//    }
////======================== End functions to get friends attribute =========================
//
////====================== Functions to get blocked_friends attribute ============================
//
//    // friendship that this user started but now blocked
//    protected function friendsOfThisUserBlocked()
//    {
//        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
//            ->withPivot('status', 'acted_user')
//            ->wherePivot('status', 'blocked')
//            ->wherePivot('acted_user', 'first_user');
//    }
//
//    // friendship that this user was asked for but now blocked
//    protected function thisUserFriendOfBlocked()
//    {
//        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
//            ->withPivot('status', 'acted_user')
//            ->wherePivot('status', 'blocked')
//            ->wherePivot('acted_user', 'second_user');
//    }
//
//    // accessor allowing you call $user->blocked_friends
//    public function getBlockedFriendsAttribute()
//    {
//        if ( ! array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
//        return $this->getRelation('blocked_friends');
//    }
//
//    protected function loadBlockedFriends()
//    {
//        if ( ! array_key_exists('blocked_friends', $this->relations))
//        {
//            $friends = $this->mergeBlockedFriends();
//            $this->setRelation('blocked_friends', $friends);
//        }
//    }
//
//    protected function mergeBlockedFriends()
//    {
//        if($temp = $this->friendsOfThisUserBlocked)
//            return $temp->merge($this->thisUserFriendOfBlocked);
//        else
//            return $this->thisUserFriendOfBlocked;
//    }
//// ======================================= End functions to get block_friends attribute =========
}
