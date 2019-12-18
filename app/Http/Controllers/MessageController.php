<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $messages = Message::where('sender', Auth::user()->id)->where('recipient', $user_id)->where('user_id', Auth::user()->id)
            ->orWhere('recipient', Auth::user()->id)->where('sender', $user_id)->where('user_id', Auth::user()->id)->get();
        //return response()->json($messages);
        return view('chat', compact('messages'))->with(['user' => $user]);
    }

    public function store(Request $request, $user_id)
    {
        $own_box = Message::create([
            'content' => $request['content'],
            'sender' => Auth::user()->id,
            'recipient' => $user_id,
            'user_id' => Auth::user()->id,
        ]);

        $friend_box = Message::create([
            'content' => $request['content'],
            'sender' => Auth::user()->id,
            'recipient' => $user_id,
            'user_id' => $user_id,
        ]);

        //return response()->json($message);
//        return response()->redirectToRoute('chat.message', $user_id);
        return redirect()->back()->with('message', 'Sent');
    }

    public function destroy($user_id, $message_id)
    {
        $message = Message::where('user_id', $user_id)->where('id', $message_id);

        $message->delete();

        return redirect()->back()->with('message', 'Deleted');
    }
}
