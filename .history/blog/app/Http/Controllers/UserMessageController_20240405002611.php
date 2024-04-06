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
            date_default_timezone_set('Asia/Taipei');
            $message_users = Message::where('senderu', $senderu)->get();
            
            //IF回復為0
            $mjoin_replys_count = Mjoin_reply::where('reply_id', $mjoinId)->count();

            $htmlContent = '<div class="SeeAllMessage">
                                <a href="#">查看全部留言</a>
                            </div>';
        } else {
            return redirect()->route('login');
        }
    }
}