<?php

namespace App\Http\Controllers;


use App\Friendship;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

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

    // Only me: 0
    // Friend: 1
    // Public: 2
    public function getPosts()
    {
        $posts = Post::where(['user_id' => Auth::user()->id])
            ->where(['privacy' => 0])
            ->orWhere(['privacy' => 1])
            ->where(['user_id' => Auth::user()->id])
            ->orWhere(['privacy' => 2]);

        return $posts->orderByDesc('created_at')->paginate(10);
    }
}
