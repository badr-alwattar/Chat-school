<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
use App\Events\NewMessage;

class MessagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMessages() {
        $id = Auth::user()->id;
        $messages = Message::where('sender_id', $id)->orWhere('receiver_id', $id)->get();

        return response()->json($messages);

    }

    public function send(Request $request) {
        // dd('test');
        $message = Message::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'body' => $request->body
        ]);

        broadcast(new NewMessage($message))->toOthers();

        return response()->json($message);

    }
}
