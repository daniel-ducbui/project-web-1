<?php

namespace App\Traits;

use App\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\User;
use App\Post;

trait Likeable
{
    public function countLikes($this_post)
    {
        return Like::where(['post_id' => $this_post->id])->get();
    }

    public function like($post)
    {
        $user = Auth::user();

        if (!$post) {
            return false;
        } else {
            $like = $user->likes()->where('post_id', $post->id)->first();

            if ($this->isLike($post)) {
                $like->delete();
            } else {
                Like::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            }
        }
    }

    public function isLike($post)
    {
        return Like::where('post_id', $post->id)->where('user_id', Auth::user()->id)->exists();
    }
}
