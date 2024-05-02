<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        return view('auth.chat', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->message = $request->message;
        $message->save();

        return redirect()->back();
    }
}
