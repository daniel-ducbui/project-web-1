<?php

namespace App\Traits;

use App\Friendship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait Friendable
{
    // Status
    // 0: Nothing -> can befriend
    // 1: Pending
    // 2: Accepted
    // 3: Denied
    // 4: Following

    public function befriend($recipient)
    {
        $status = $this->canBefriend((int)$recipient);

        // Hành hành động với mỗi status
        if ($status == 0) {
            $friendship = Friendship::create([
                'sender' => Auth::user()->id,
                'recipient' => $recipient,
                'status' => 1,
            ]);
        } elseif ($status == 1) {
            return 'Pending';
        } elseif ($status == 2) {
            return 'Accepted';
        } elseif ($status == 3) {
            return 'Denied';
        } elseif ($status == 4) {
            return 'Following';
        }

        return $friendship ? 'Friend requests has sent' : 'Something wrong! Please try again later.';
    }

    public function hasFriendRequestFrom($recipient)
    {
        $friendship = $this->getFriendship($recipient);
        if ($friendship->sender == Auth::user()->id) {
            return true;
        }
        return false;
    }

    public function getFriendship($recipient)
    {
        return Friendship::where(['sender' => Auth::user()->id, 'recipient' => $recipient])->exists();
    }

    public function canBefriend($recipient)
    {
//        dd($sender, $recipient);
        $friendship = $this->getFriendship($recipient);
//        dd($friendship->status, $sender, $recipient);
        if ($friendship) {
            $status = $friendship->status;
            return $status = 1 ? $status : $status = 2 ? $status : $status = 3 ? $status : 4;
        }
        // Trả về status
        return 0;
    }

    public function accept()
    {
        // I am here
    }
}
