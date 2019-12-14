<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\Http\Requests\PostsFormRequest;
use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    // Only me: 0
    // Friend: 1
    // Public: 2
    public function index()
    {
        $user = Auth::user();

        $posts = $this->getPosts();

        // Get friendships
        $accepted = Auth::user()->getAcceptedFriendships();
        // Get pending
        $pending = Auth::user()->getPendingFriendships();

        return view('home', compact('posts', 'accepted', 'pending'))->with(['user' => $user]);
    }

    public function getPosts()
    {
        $posts = Post::where(['user_id' => Auth::user()->id])
            ->Where(['privacy' => 1])
            ->orWhere(['privacy' => 2])
            ->orWhere(['privacy' => 0])
            ->where(['user_id' => Auth::user()->id]);

        return $posts->orderByDesc('created_at')->paginate(10);
    }
}
