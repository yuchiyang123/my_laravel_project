<?php

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
        $message->message = $request->message;
        $message->save();

        return redirect()->back();
    }
}
