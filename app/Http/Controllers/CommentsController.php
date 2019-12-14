<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentsController extends Controller
{
    //
    public function store(Request $request, $post)
    {
        $user = Auth::user();

        $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'post_id' => $post,
            'user_id' => $user->id,
            'content' => $request['content'],
        ]);

        return redirect()->back()->with('message', 'Commented');
    }
}
