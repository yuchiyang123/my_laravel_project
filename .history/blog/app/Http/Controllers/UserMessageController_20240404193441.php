<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Message;
use Illuminate\Http\Request;

use function Illuminate\Validation\Rules\message;

class UserMessageController extends Controller
{
    public function message_show()
    {
        session(['user_name' => $username]);
        session(['user_email' => $useremail]);

        $messages = Message::orderBy('id','desc')
                            ->where('receivere',$useremail)
                            ->where('receiveru',$username)
                            ->get();
        
        return view('auth.Message',compact('messages'));
    }
}