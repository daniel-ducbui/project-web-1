<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
      'content', 'sender', 'recipient',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
