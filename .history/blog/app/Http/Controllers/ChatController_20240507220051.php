<?php

namespace App\Services;
namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Messagenew;
use Illuminate\Support\Facades\Redis;
use App\Events\msg;
use App\Events\msg_outside;
use App\Events\msg_outside1;
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
            return redirect()->route('login')->with('error', '請先登入');
        }
        /*$messages = Messagenew::where('user_id', Auth::user()->id)
                      ->whereIn('id', function ($query) {
                            $query->selectRaw('max(id)')
                                  ->from('messages')
                                  ->whereColumn('receiver_id', 'messages.receiver_id')
                                  ->groupBy('receiver_id');
                      })
                      ->orderBy('id', 'desc')
                      ->get();*/

                      
                      $userId = Auth::id();
                      /*
                      $messages = Messagenew::
                      where('user_id', $userId)
                      ->orWhere('receiver_id', $userId)
                      ->orderBy('id', 'desc')
                      ->get();*/
                      $messages = Messagenew::where(function ($query) use ($userId) {
                        $query->where('user_id', $userId)
                              ->orWhere('receiver_id', $userId);
                    })
                    ->whereNot(function ($query) use ($userId) {
                        $query->where('user_id', $userId)
                              ->where('receiver_id', $userId);
                    })
                    ->orderBy('id', 'desc')
                    ->get();
                      
        $count = $messages->count();
        if(!$messages){
            return view('auth.Message', compact('messages','count'));
        }


        return view('auth.Message', compact('messages','count'));
    }
    public function store(Request $request)
    {
        $message = new Messagenew();
        $message->user_id = '2';
        $message->receiver_id = '1';
        $message->message = '123456';
        $message->is_read = false;
        

        $message->created_at = Carbon::now();
        //dd($message->created_at);
        $message->save();
        $data = [
            'user_id' => $message->user_id,
            'receiver_id' => $message->receiver_id,
            'message' => $message->message,
            'is_read' => $message->is_read,
            'created_at' => $message->created_at->format('Y-m-d H:i:s'),
        ];

        $fromUserId = 1;  // 假設的發訊人 ID
        $toUserId = 2;    // 假設的收訊人 ID
        //$message = "Hello, this is a private message between us.";
        //dd($message->count());
        $count = $message::where('user_id', $fromUserId)->where('receiver_id', $toUserId)->count();
        broadcast(new msg($message->user_id, $message->receiver_id, $message->message));
        if($count <=1 ){
            //dd(1);
            broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
        } else {
            //dd(2);
            broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
        }
        
        //dd(Carbon::parse($message->created_at)->diffForHumans());
        //broadcast(new PostGoodCountUpdated($mjoinId, $goodcount));
        //Redis::publish('chat', json_encode($data));

        return response()->json(['success' => true,'data'=> $data]);
    }
}
