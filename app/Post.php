<?php

namespace App;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeable;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_content',
        'post_photo',
        'privacy',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
