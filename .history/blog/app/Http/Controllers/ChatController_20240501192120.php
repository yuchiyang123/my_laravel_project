<?php

namespace App\Http\Controllers;
namespace App\Models;
use Illuminate\Http\Request;
use App\Models\Messagenew;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
