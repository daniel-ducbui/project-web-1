<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsFormRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

        return $dst;
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
                $imagePath = "..\src\images\post\/";
                // Get file name
                $imageName = $image->getClientOriginalName();

                $imageName = '_temp.jpg';
                // Store file
                $image->move(public_path($imagePath), $imageName);
                // Resize image --> Pending
                $ri = $this->resize_image(public_path($imagePath . $imageName), 1080, 1080);
                imagejpeg($ri, public_path($imagePath . $imageName));

                // Convert to string
                $imageTmp = file_get_contents(public_path($imagePath . $imageName));
                // Save data to database
                $post->post_photo = $imageTmp;
            }

            if ($request->user()->posts()->save($post)) {
                $noti = 'Status posted';
            }
        }

        return response()->redirectToRoute('home')->with(['message' => $noti]);
    }

    public function findPostById($post_id)
    {
        return Post::where('id', $post_id)->first();
    }

    public function destroy($post_id)
    {
        $post = $this->findPostById($post_id);

        if (Auth::user() != $post->user) {
            return redirect()->back()->with(['message' => 'Can not delete!']);
        }
        // Else
        $post->delete();

        return redirect()->route('home')->with(['message' => 'Post deleted']);
    }

    public function show($post_id)
    {
        $p = $this->findPostById($post_id);

        return view('partials.edit-post', compact('p'))->with('user', Auth::user());
    }

    public function edit(Request $request, $post_id)
    {
        $p = $this->findPostById($post_id);

        if ($request['privacy'] != $p->privacy) {

            $p->update([
                'privacy' => $request['privacy'],
            ]);

            return redirect()->back()->with('message', 'Saved');
        }

        return redirect()->back()->with('message', 'Nothing to save!');
    }
}
