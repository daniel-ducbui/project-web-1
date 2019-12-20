<?php

namespace App\Http\Controllers;

use App\Mail\SendMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;
use Illuminate\Support\Facades\Mail;

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
            ->orWhere('recipient', Auth::user()->id)->where('sender', $user_id)->where('user_id', Auth::user()->id)->orderByDesc('created_at')->get();

        // Get friendships
        $accepted = Auth::user()->getAcceptedFriendships();
        // Get pending
        $pending = Auth::user()->getPendingFriendships();

        //return response()->json($messages);
        return view('chat', compact('messages', 'accepted', 'pending'))->with(['user' => $user]);
    }

    public function store(Request $request, $user_id)
    {
        $request->validate([
           'content' => 'string|min:1',
        ]);

        $content = $request['content'];
        $content_path = substr($content, 0, 10) . '...';

        $own_box = Message::create([
            'content' => $content,
            'sender' => Auth::user()->id,
            'recipient' => $user_id,
            'user_id' => Auth::user()->id,
        ]);

        $friend_box = Message::create([
            'content' => $content,
            'sender' => Auth::user()->id,
            'recipient' => $user_id,
            'user_id' => $user_id,
        ]);

        // Send mail
        $user = User::where('id', $user_id)->first();
        $auth = Auth::user();

        $details = [
            'title' => 'New message',
            'body' => "You have new message from $auth->name",
            'messages' => $content_path,
        ];

        // Mail::to($user->email)->send(new SendMailable($details));

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
