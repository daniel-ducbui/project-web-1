<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function userProfile($user_name, $user_id)
    {
        $user = User::where('id', $user_id)->first();

        $posts = $this->getPost($user_id);

        // Get friendships
        $accepted = Auth::user()->getAcceptedFriendships();
        // Get pending
        $pending = Auth::user()->getPendingFriendships();

        return view('partials.user-profile', compact('posts', 'accepted', 'pending'))->with(['user' => $user]);
    }

    public function getPost($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (Auth::user()->id == $user->id) {
            $posts = Post::where('user_id', $user_id)
                ->orderBy('created_at', 'desc')->paginate(10); // All posts if this is user own profile
        } elseif (Auth::user()->isFriendWith($user->id)) {
            $posts = Post::where('user_id', $user_id)->where('privacy', 1)
                ->orWhere('user_id', $user_id)->where('privacy', 2)
                ->orderBy('created_at', 'desc')->paginate(10); // Posts if user is this profile friend
        } else {
            $posts = Post::where('user_id', $user_id)->where('privacy', 2)
                ->orderBy('created_at', 'desc')->paginate(10); // Posts if user is not this profile friend
        }

        return $posts;
    }

    public function userInformation()
    {
        // Change: nhấn phát chuyển qua trang cá nhân rồi mới đến trang này, trang này để thấy thông tin chi tiết --> Done
        return view('partials.change-profile-info', ['user' => Auth::user()]);
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

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            //'email' => 'required|email|max:255|unique:users',
            'profile_picture' => 'image|mimes:jpeg,gif,png,jpg,svg|max:4096',
        ]);

        $user = Auth::user();

        //// Upload image
        if ($request->file('profile_picture')) {
            // Get file
            $image = $request->file('profile_picture');
            // Directory
            $imagePath = '..\src\images\profile\/';
            // Get file name
            $imageName = $image->getClientOriginalName();

            $imageName = '_temp.jpg';
            // Store file
            $image->move(public_path($imagePath), $imageName);
            // Resize image --> Pending
            $ri = $this->resize_image(public_path($imagePath . $imageName), 1080, 1080, true);
            imagejpeg($ri, public_path($imagePath . $imageName));

            // Convert to string
            $imageTmp = file_get_contents(public_path($imagePath . $imageName));
            // Save data to database
            $user->profile_picture = $imageTmp;
        } else {
            $imageTmp = $user->profile_picture;
        }

        $user->update([
            'name' => $request->get('name'),
            'dob' => $request->get('dob'),
            'profile_picture' => $imageTmp,
        ]);

        if (($request->phone_number != $user->phone_number) && $this->validate($request, ['phone_number' => 'required|max:10|unique:users'])) {
            $user->update([
                'phone_number' => $request->get('phone_number'),
            ]);
        }

        if (($request->email != $user->email) && $this->validate($request, ['email' => 'required|email|max:255|unique:users|regex:/^.+@.+$/i'])) {
            $user->update([
                'email' => $request->get('email'),
            ]);
        }

        return redirect()->back()->with('message', 'Profile details updated');
    }
}
