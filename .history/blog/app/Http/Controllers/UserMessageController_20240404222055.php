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
            $messages = Message::orderBy('id', 'desc')
                                ->where('receivere', $useremail)
                                ->where('receiveru', $username)
                                ->toSql();
    
            // 显示消息中心页面
            return view('auth.Message', compact('messages'));
        } else {
            // 如果用户未登录，则重定向到登录页面
            return redirect()->route('login');
        }
    }
}