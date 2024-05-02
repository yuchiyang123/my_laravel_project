<?php

namespace App\Services;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messagenew;
use LRedis;


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
        
        //broadcast(new \App\Events\NewMessageEvent($message));
        //dd($request);
        //return response()->json(['htmlContent' => $htmlContent]);
        $redis = LRedis::connection();
        $redis->publish('message', json_encode($message));
        //return redirect()->back();
        return response()->json(true);
    }
}
