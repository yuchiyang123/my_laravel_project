<?php

namespace App\Services;
namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Messagenew;
use Illuminate\Support\Facades\Redis;
use App\Events\msg;
use App\Events\msg_outside;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($receiver_id)
    {
        $messages = Messagenew::where('receiver_id', Auth::user()->id)
                                ->orWhere('user_id', Auth::user()->id)
                                ->get();
        $messagessolo = Messagenew::where('receiver_id', Auth::user()->id)
                                ->orWhere('user_id', Auth::user()->id)
                                ->first();
        return view('auth.message_d', compact('messages','messagessolo','receiver_id'));
    }
    public function message_d()
    {
        if(!Auth::check()){
            return redirect()->route('login')>with('error', '請先登入');
        }
        $messages = Messagenew::where('user_id', Auth::user()->id)
                      ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('messages')
                                  ->whereColumn('receiver_id', 'messages.receiver_id')
                                  ->groupBy('receiver_id');
                      })
                      ->orderBy('id', 'desc')
                      ->get();
                      
        if(!$messages){
            return redirect()->route('auth.Message');
        }


        return view('auth.Message', compact('messages'));
    }
    public function store(Request $request)
    {
        $message = new Messagenew();
        $message->user_id = '1';
        $message->receiver_id = '2';
        $message->message = '123456';
        $message->is_read = false;
        $message->created_at->format('Y-m-d H:i:s');
        $message->save();

        $data = [
            'user_id' => $message->user_id,
            'receiver_id' => $message->receiver_id,
            'message' => $message->message,
            'is_read' => $message->is_read,
        ];

        $fromUserId = 1;  // 假設的發訊人 ID
        $toUserId = 2;    // 假設的收訊人 ID
        //$message = "Hello, this is a private message between us.";
        
        broadcast(new msg($message->user_id, $message->receiver_id, $message->message));
        broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
        ,Carbon::parse($message->created_at)->diffForHumans()));

        //broadcast(new PostGoodCountUpdated($mjoinId, $goodcount));
        //Redis::publish('chat', json_encode($data));

        return response()->json(['success' => true,'data'=> $data]);
    }
}
