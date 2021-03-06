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
