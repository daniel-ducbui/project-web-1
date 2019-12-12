<?php

namespace App\Http\Controllers;

use App\Friendship;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipsController extends Controller
{
    //
    // Status
    // 0: Pending
    // 1: Accepted
    // 2: Denied
    // Unfriend -> delete all field relate to this friendship in database

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function send($name, $recipient_id)
    {
        Auth::user()->befriend($recipient_id);

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
        return redirect()->back()->with(['message' => 'Followed']);
    }

    public function unfollow($name, $recipient_id)
    {
        Auth::user()->unfollow($recipient_id);
        return redirect()->back()->with(['message' => 'Unfollowed']);
    }
}
