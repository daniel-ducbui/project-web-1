<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    //
    protected $fillable = [
        'sender', 'recipient', 'status',
        ];

    public function sender()
    {
        return $this->getAttribute('sender');
    }

    public function recipient()
    {
        return $this->getAttribute('recipient');
    }

    public function user()
    {
        return $this->hasMany('App\Friendship', 'id', 'id');
    }

    public function findUserById($id)
    {
        return User::where('id', $id)->first();
    }
}
