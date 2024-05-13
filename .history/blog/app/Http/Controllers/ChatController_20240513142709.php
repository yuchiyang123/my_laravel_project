<?php

namespace App\Services;
namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\Messagenew;
use Illuminate\Support\Facades\Redis;
use App\Events\msg;
use App\Events\msg_outside;
use App\Events\msg_outside1;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class ChatController extends Controller
{
    //外
    public function index($receiver_id)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', '請先登入');
        }
        if(Auth::user()->id == $receiver_id){
            session()->flash('warning', '不能與自己聊天');
            
            // 將用戶重定向回上一個URL
            return redirect()->back();
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

        $messagese = Messagenew::where(function ($query) use ($receiver_id) {
            $query->where('receiver_id', Auth::user()->id)
                  ->where('user_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('user_id', Auth::user()->id)
                  ->where('receiver_id', $receiver_id);
        })->get();
        
        /*$messagessolo = Messagenew::where('receiver_id', Auth::user()->id)
                                ->orWhere('user_id', Auth::user()->id)
                                ->first();*/
                                /*$messages = Messagenew::where('user_id', Auth::user()->id)
                                ->whereIn('id', function ($query) {
                                      $query->selectRaw('max(id)')
                                            ->from('messages')
                                            ->whereColumn('receiver_id', $receiver_id)
                                            ->groupBy('receiver_id');
                                })
                                ->orderBy('id', 'desc')
                                ->get();*/
          

        return view('auth.message_d', compact('messages','messagese','receiver_id'));
    }
    //裡
    public function message_d()
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('error', '請先登入');
        }
        
        $messages = Messagenew::orWhere('user_id', Auth::user()->id)
                                ->whereIn('id', function ($query) {
                                    $query->selectRaw('max(id)')
                                            ->from('messages')
                                            ->whereColumn('receiver_id', 'messages.receiver_id')
                                            ->groupBy('receiver_id');
                                })
                                ->orWhere('receiver_id', Auth::user()->id)
                                ->whereIn('id', function ($query) {
                                    $query->selectRaw('max(id)')
                                            ->from('messages')
                                            ->whereColumn('user_id', 'messages.user_id')
                                            ->groupBy('user_id');
                                })
                                ->orderBy('id', 'desc')
                                ->distinct()
                                ->get();


        /*$messages = Messagenew::selectRaw('DISTINCT 
                      CASE 
                          WHEN user_id = ? THEN receiver_id 
                          ELSE user_id 
                      END AS other_user_id,
                      message,
                      created_at', [Auth::user()->id])
                  ->where('user_id', Auth::user()->id)
                  ->orWhere('receiver_id', Auth::user()->id)
                  ->orderBy('created_at', 'DESC')
                  ->get();*/

                      /*$messages = Messagenew::orwhere('user_id', Auth::user()->id)
                      ->orwhere('receiver_id', Auth::user()->id)
                      ->orderBy('id', 'desc')
                      ->distinct()
                      ->get();*/
        //$messages = Messagenew::->distinct();
                      
                      $userId = Auth::id();
                      
                      /*$messages = Messagenew::
                      where('user_id', $userId)
                      ->orWhere('receiver_id', $userId)
                      ->orderBy('id', 'desc')
                      ->get();*/
                      /*$messages = Messagenew::where(function ($query) use ($userId) {
                        $query->where('user_id', $userId)
                              ->orWhere('receiver_id', $userId);
                    })
                    ->orderBy('id', 'desc')
                    ->distinct()
                    ->get();*/

                      
        $count = $messages->count();
        if(!$messages){
            return view('auth.Message', compact('messages','count'));
        }


        return view('auth.Message', compact('messages','count'));
    }
    public function store($receiver_id)
    {
        $message = new Messagenew();
        $message->user_id = Auth::user()->id;
        $message->receiver_id = $receiver_id;
        $message->message = request('message');
        $message->is_read = false;
        

        $message->created_at = Carbon::now();
        //dd($message->created_at);
        if($message->user_id == $message->receiver_id){
            $js = "<script>alert('User ID and Receiver ID exist.');</script>";
            return Response::make($js);
        }
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
        //$count = $message::where('user_id', $fromUserId)->where('receiver_id', $toUserId)->count();
        //if($message->user_id == Auth::user()->id && $message->receiver_id != Auth::user()->id)
        broadcast(new msg($message->user_id, $message->receiver_id, $message->message));
        //elseif($message->receiver_id == Auth::user()->id && $message->user_id != Auth::user()->id)
            //broadcast(new msg($message->receiver_id, $message->user_id, $message->message));
        /*if($count <=1 ){
            //dd(1);
            broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
        } else {
            //dd(2);
            broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
        }*/

        if($message->user_id == Auth::user()->id && $message->receiver_id != Auth::user()->id){
            //dd(1);
            broadcast(new msg_outside($message->id,$message->receiver_id,$message->user_id,  $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
            broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
        } elseif($message->receiver_id == Auth::user()->id && $message->user_id != Auth::user()->id) {
            //dd(2);
            broadcast(new msg_outside($message->id,$message->user_id, $message->receiver_id, $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
            broadcast(new msg_outside($message->id,$message->receiver_id,$message->user_id,  $message->message
            ,Carbon::parse($message->created_at)->diffForHumans()));
        } 
        
        //dd(Carbon::parse($message->created_at)->diffForHumans());
        //broadcast(new PostGoodCountUpdated($mjoinId, $goodcount));
        //Redis::publish('chat', json_encode($data));

        return response()->json(['success' => true,'data'=> $data]);
    }
}
