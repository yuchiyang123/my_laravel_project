<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Models\Message;
use Illuminate\Http\Request;

use function Illuminate\Validation\Rules\message;

class UserMessageController extends Controller
{
    public function message_show()
    {
        if (Auth::check()) {
            // 从会话中检索用户信息
            $username = session('user_name');
            $useremail = session('user_email');
    
            // 使用会话信息检索消息
            $senders = Message::select('sendere')
                                ->orderBy('created_at', 'desc')
                                ->where('receivere', $useremail)
                                ->distinct()
                                ->get();
            
            $messages = [];

            foreach ($senders as $sender) {
                $message = Message::orderBy('id', 'desc')
                    ->where('receivere', $useremail)
                    ->where('sendere', $sender->sendere)
                    ->first();
    
                if ($message) {
                    $messages[] = $message;
                }
            }
            // 显示消息中心页面
            return view('auth.Message', compact('messages'));
        } else {
            // 如果用户未登录，则重定向到登录页面
            return redirect()->route('login');
        }
    }

    public function message_show_solo($senderu)
    {
        if (Auth::check()) {
            $username = session('user_name');
            $useremail = session('user_email');
            date_default_timezone_set('Asia/Taipei');

            $message_users = Message::where(function ($query) use ($senderu, $username) {
                        $query->where('senderu', $senderu)
                              ->where('receiveru', $username);
                    })
                    ->orWhere(function ($query) use ($senderu, $username) {
                        $query->where('senderu', $username)
                              ->where('receiveru', $senderu);
                    })
                    ->get();
            
            foreach($message_users as $message_user){
                if($message_user->senderu === $username){

                }
            }
        

            $htmlContent = '<div class="SeeAllMessage">
                                <a href="#">查看全部留言</a>
                            </div>';
        } else {
            return redirect()->route('login');
        }
    }
}