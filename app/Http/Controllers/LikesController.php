<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function like($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        $post->like($post);

        return redirect()->back();
    }
}
