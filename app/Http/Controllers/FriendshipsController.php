<?php

namespace App\Http\Controllers;
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

    public function send($name, $recipient)
    {
        $user = User::where('id', $recipient)->first();
        Auth::user()->befriend($user);
        return redirect()->back()->with(['user' => $user, 'message' => 'Friend requests has sent']);
    }

    public function accept($name, $sender)
    {
        $user = User::where('id', $sender)->first();
        Auth::user()->acceptFriendRequest($user);
        return redirect()->back()->with(['user' => $user, 'message' => 'Friend requests has accepted. You are now friend']);
    }

    public function deny($name, $sender)
    {
        $user = User::where('id', $sender)->first();
        Auth::user()->denyFriendRequest($user);
        return redirect()->back()->with(['user' => $user, 'message' => 'Friend requests has denied']);
    }

    public function unfriend($name, $friend)
    {
        $user = User::where('id', $friend)->first();
        Auth::user()->unfriend($user);
        return redirect()->back()->with(['user' => $user, 'message' => 'Unfriend']);
    }
}
