<?php

namespace App\Services;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messagenew;
use Illuminate\Support\Facades\Redis;
use App\Models\msg;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Messagenew::all();
        return view('auth.chatindex', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = new Messagenew();
        $message->user_id = '1';
        $message->receiver_id = '2';
        $message->message = $request->message;
        $message->is_read = false;
        $message->save();

        $data = [
            'user_id' => $message->user_id,
            'receiver_id' => $message->receiver_id,
            'message' => $message->message,
            'is_read' => $message->is_read,
        ];
        $fromUserId = 1;  // 假設的發訊人 ID
        $toUserId = 2;    // 假設的收訊人 ID
        $message = "Hello, this is a private message between us.";

        event(new msg($fromUserId, $toUserId, $message));


        //Redis::publish('chat', json_encode($data));

        return response()->json(['success' => true,'data'=> $data]);
    }
}
