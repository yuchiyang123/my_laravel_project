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
            $htmlContent_head = 
                '<div class="py-2 px-4 border-bottom d-none d-lg-block">
                    <div class="d-flex align-items-center py-1">
                        <div class="position-relative">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="'.$senderu.'" width="40" height="40">
                        </div>
                        <div class="flex-grow-1 pl-3">
                            <strong>'.$senderu.'</strong>
                            <div class="text-muted small"><em></em></div>
                        </div>
                    </div>
                </div>';
            $message_users = Message::where(function ($query) use ($senderu, $username) {
                        $query->where('senderu', $senderu)
                              ->where('receiveru', $username);
                    })
                    ->orWhere(function ($query) use ($senderu, $username) {
                        $query->where('senderu', $username)
                              ->where('receiveru', $senderu);
                    })
                    ->get();
            $htmlContent = null;
            foreach($message_users as $message_user){
                if($message_user->senderu === $username){
                    $htmlContent .= 
                        '<div class="chat-message-right pb-4">
                            <div>
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="'.$useremail.'" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">2:33 am</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                <div class="font-weight-bold mb-1">You</div>
                                '.$message_user->main.'
                            </div>
                        </div>';
                }else if($message_user->senderu === $senderu){
                    $htmlContent .=
                        '<div class="chat-message-left pb-4">
                            <div>
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="'.$senderu.'" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">2:34 am</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                <div class="font-weight-bold mb-1">'.$senderu.'</div>
                                '.$message_user->main.'
                            </div>
                        </div>';
                }
            }
            //訊息送出
            $htmlContent .=
            '<form action="' . route('front.reply.submit', ['senderu' => $username]) . '" method="POST">
                ' . csrf_field() . '
                <div class="chat-message bottom-container py-3 px-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Type your message" id="' . $senderu . '">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>';
            return response()->json([
                'htmlContent_message' => $htmlContent,
                'htmlContent_head' => $htmlContent_head
            ]);
            
        } else {
            return redirect()->route('login');
        }
    }
}