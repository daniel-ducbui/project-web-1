<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;

class MessageController extends Controller
{
    //
    public function index($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $messages = Message::where('sender', Auth::user()->id)->where('recipient', $user_id)
            ->orWhere('recipient', Auth::user()->id)->where('sender', $user_id)->get();
        //return response()->json($messages);
        return view('chat', compact('messages'))->with(['user' => $user]);
    }

    public function store(Request $request, $user_id)
    {
        $message = Message::create([
            'content' => $request['content'],
            'sender' => Auth::user()->id,
            'recipient' => $user_id,
        ]);

        //return response()->json($message);
//        return response()->redirectToRoute('chat.message', $user_id);
        return redirect()->back()->with('message', 'Sent');
    }
}
