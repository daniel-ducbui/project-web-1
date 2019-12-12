<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Friendship;
use App\User;

trait Friendable
{
    // 0: Pending
    // 1: Friend
    // 2: Following

    public function befriend($recipient_id)
    {
        $friendships = new Friendship();

        $friendships->create([
            'sender' => Auth::user()->id,
            'recipient' => $recipient_id,
            'status' => 0,
        ]);

        return $friendships;
    }

    public function unfriend($this_user)
    {
        return Friendship::where(['sender' => Auth::user()->id])->where(['recipient' => $this_user])->where('status', 1)
            ->orWhere(['recipient' => Auth::user()->id])->where(['sender' => $this_user])->where('status', 1)
            ->delete();
    }

    public function isFriendWith($this_user)
    {
        return Friendship::where(['sender' => Auth::user()->id])->where(['recipient' => $this_user])->where('status', 1)
            ->orWhere(['recipient' => Auth::user()->id])->where(['sender' => $this_user])->where('status', 1)
            ->exists();
    }

    public function hasFriendRequestFrom($recipient_id)
    {
        return Friendship::where('recipient', Auth::user()->id)->where('sender', $recipient_id)->where('status', 0)->exists();
    }

    public function hasSentFriendRequestTo($recipient_id)
    {
        return Friendship::where('sender', Auth::user()->id)->where('recipient', $recipient_id)->where('status', 0)->exists();
    }

    public function acceptFriendRequest($sender_id)
    {
        $friendships = Friendship::where('sender', $sender_id)->where('recipient', Auth::user()->id);

        $friendships->update([
            'status' => 1,
        ]);

        return $friendships;
    }

    public function denyFriendRequest($sender_id)
    {
        $friendships = Friendship::where('sender', $sender_id)->where('recipient', Auth::user()->id)->where('status', 0);

        $friendships->delete();

        return $friendships;
    }

    public function cancelFriendRequest($recipient_id)
    {
        return Friendship::where(['sender' => Auth::user()->id])->where(['recipient' => $recipient_id])->where('status', 0)
            ->delete();
    }

    public function follow($recipient_id)
    {
        $friendships = new Friendship();

        $friendships->create([
            'sender' => Auth::user()->id,
            'recipient' => $recipient_id,
            'status' => 2,
        ]);

        return $friendships;
    }

    public function isFollowing($recipient_id)
    {
        return Friendship::where(['sender' => Auth::user()->id])->where(['recipient' => $recipient_id])->where('status', 2)
            ->exists();
    }

    public function unfollow($recipient_id)
    {
        $friendships = Friendship::where('sender', Auth::user()->id)->where('recipient', $recipient_id)->where('status', 2);

        $friendships->delete();

        return $friendships;
    }

    public function getAcceptedFriendships()
    {
        return Friendship::where(['sender' => Auth::user()->id, 'status' => 1])->orWhere(['recipient' => Auth::user()->id, 'status' => 1])->get();
    }

    public function getPendingFriendships()
    {
        return Friendship::where(['sender' => Auth::user()->id, 'status' => 0])->orWhere(['recipient' => Auth::user()->id, 'status' => 0])->get();
    }
}
