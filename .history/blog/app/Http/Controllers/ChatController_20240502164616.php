<?php

namespace App\Services;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messagenew;
use Illuminate\Support\Facades\Redis;


class ChatController extends Controller
{
    public function index()
    {
        $messages = Messagenew::all();
        return view('auth.chat', compact('messages'));
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

        Redis::publish('chat', json_encode($data));

        return response()->json(true);
    }
}
