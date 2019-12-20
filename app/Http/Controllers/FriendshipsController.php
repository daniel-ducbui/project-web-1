<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\Mail\SendMailable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FriendshipsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function send($name, $recipient_id)
    {
        $user = User::where('id', $recipient_id)->first();
        $auth = Auth::user();

        $auth->befriend($recipient_id);

        $details = [
            'title' => 'New friend request',
            'body' => "You have new friend request from $auth->name",
            'url' => "http://127.0.0.1:8000/profile/$auth->name/$auth->id",
        ];

        // Mail::to($user->email)->send(new SendMailable($details));

        return redirect()->back()->with(['message' => 'Friend requests has sent']);
    }

    public function accept($name, $sender_id)
    {
        Auth::user()->acceptFriendRequest($sender_id);
        return redirect()->back()->with(['message' => 'Friend requests has accepted. You are now friend']);
    }

    public function deny($name, $sender_id)
    {
        Auth::user()->denyFriendRequest($sender_id);
        return redirect()->back()->with(['message' => 'Friend requests has denied']);
    }

    public function unfriend($name, $this_user)
    {
        Auth::user()->unfriend($this_user);
        return redirect()->back()->with(['message' => 'Unfriended']);
    }

    public function cancel($name, $this_user)
    {
        Auth::user()->cancelFriendRequest($this_user);
        return redirect()->back()->with(['message' => 'Cancelled']);
    }

    public function follow($name, $recipient_id)
    {
        Auth::user()->follow($recipient_id);
        return redirect()->back()->with(['message' => 'Following']);
    }

    public function unfollow($name, $recipient_id)
    {
        Auth::user()->unfollow($recipient_id);
        return redirect()->back()->with(['message' => 'Unfollowed']);
    }
}
