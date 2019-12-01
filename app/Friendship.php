<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    //
    protected $fillable = [
        'sender', 'recipient', 'status',
    ];

    public function friendship()
    {
        return $this->hasMany(Friendship::class, 'sender', 'recipient');
    }
}
