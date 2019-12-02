<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsFormRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Login;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Get posts
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        // Get friendships
        $friendships = Auth::user()->getAcceptedFriendships();

        return view('home', compact('posts', 'friendships'))->with(['user' => $user]);
    }

    public function store(PostsFormRequest $request)
    {
        $user = Auth::user();

        $post = new Post();

        $noti = 'Something wrong here! Try again later!';

        if (!$request->file('post_photo') && !$request->get('post_content')) {
            $noti = 'Post what?';
        } else {
            $post->privacy = $request['privacy'];

            if ($request['post_content']) {
                $post->post_content = $request['post_content'];
            }

            //// Upload image
            if ($request->file('post_photo')) {
                // Get file
                $image = $request->file('post_photo');
                // Directory
                $imagePath = 'src/images/post/';
                // Get file name
                $imageName = $image->getClientOriginalName();

                $imageName = '_temp.jpg';
                // Store file
                $image->move(public_path($imagePath), $imageName);
                // Resize image --> Pending


                // Convert to string
                $imageTmp = file_get_contents($imagePath . $imageName);
                // Save data to database
                $post->post_photo = $imageTmp;
            }

            if ($request->user()->posts()->save($post)) {
                $noti = 'Status posted';
            }
        }

        return response()->redirectToRoute('home')->with(['message' => $noti]);
    }

    public function destroy($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        if (Auth::user() != $post->user) {
            return redirect()->back()->with(['message' => 'Can not delete!']);
        }
        // Else
        $post->delete();

        return redirect()->back()->with(['message' => 'Post deleted']);
    }

    public function edit()
    {
        // Pending
        return redirect()->back()->with('message', 'Function is not done yet!');
    }
}
