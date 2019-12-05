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

//        // Get friendships
//        $accepted = Auth::user()->getAcceptedFriendships();
//        // Get pending
//        $pending = Auth::user()->getPendingFriendships();

        return view('partials.user-profile', compact('posts'))->with(['user' => $user]);
    }

    public function userInformation()
    {
        // Change: nhấn phát chuyển qua trang cá nhân rồi mới đến trang này, trang này để thấy thông tin chi tiết --> Done
        return view('partials.change-profile-info', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            //'email' => 'required|email|max:255|unique:users',
            //'phone_number' => 'required|max:10|unique:users',
            'profile_picture' => 'image|mimes:jpeg,gif,png,jpg,svg|max:4096',
        ]);

        $user = Auth::user();

        //// Upload image
        if ($request->file('profile_picture')) {
            // Get file
            $image = $request->file('profile_picture');
            // Directory
            $imagePath = 'src/images/profile/';
            // Get file name
            $imageName = $image->getClientOriginalName();

            $imageName = '_temp.jpg';
            // Store file
            $image->move(public_path($imagePath), $imageName);
            // Resize image --> Pending
            //??
            // Convert to string
            $imageTmp = file_get_contents($imagePath . $imageName);
            // Save data to database
            $user->profile_picture = $imageTmp;
        } else {
            $imageTmp = $user->profile_picture;
        }

        $user->update([
            'name' => $request->get('name'),
            'dob' => $request->get('dob'),
            //'email' => $request->get('email'),
            //'phone_number' => $request->get('phone_number'),
            'profile_picture' => $imageTmp,
        ]);

        return redirect()->back()->with('message', 'Profile details updated');
    }
}
