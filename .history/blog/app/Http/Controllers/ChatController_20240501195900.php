<?php

namespace App\Services;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messagenew;



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
        $message->user_id = '4';
        $message->receiver_id = '5';
        $message->message = $request->message;
        $message->is_read = false;
        $message->save();
        dd($request);
        //return view('auth.chat', compact('messages'));
    }
}
