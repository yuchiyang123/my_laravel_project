<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGood;
use Carbon\Carbon;
use App\Events\PostGoodCountUpdated;


class UserGoodController extends Controller
{
    //揪團讚數
    public function mjoin_post_countgood($mjoinId)
    {
        $goodcount = UserGood::where('reply_id', $mjoinId)
                             ->where('great_code', 'mjoin')
                             ->where('many','1')
                             ->count();
        
        
        return response()->json(['count' => $goodcount]);

    }

    //揪團讚讚檢查
    public function mjoin_post_checkgood($mjoinId)
    {
        date_default_timezone_set('Asia/Taipei');
        $username = session('user_name');
        $useremail = session('user_email');
        $goodcheck = UserGood::where('reply_id',$mjoinId)
                             ->where('great_code','mjoin')
                             ->where('clickgood_u',$username)
                             ->where('clickgood_e',$useremail)
                             ->first();
        if(!$goodcheck || $goodcheck->many==0){
            return response()->json(['status' => 'false']);
        } else {
            return response()->json(['status' => 'true']);
        }
    }

    //揪團取消讚
    public function mjoin_post_ungood($mjoinId)
    {
        date_default_timezone_set('Asia/Taipei');
        $username = session('user_name');
        $useremail = session('user_email');
        if(Auth::check()){
            $goodfind = UserGood::where('reply_id',$mjoinId)
                                ->where('great_code','mjoin')
                                ->where('clickgood_u',$username)
                                ->where('clickgood_e',$useremail)
                                ->first();
            
                $goodfind->many = '0'; // 根據當前的狀態更新按讚數
                $goodfind->status = 'false'; // 切換按讚狀態
                $goodfind->update();
                
            $goodcount = UserGood::where('reply_id', $mjoinId)
                                 ->where('great_code', 'mjoin')
                                 ->where('many','1')
                                 ->count();

            broadcast(new PostGoodCountUpdated($mjoinId, $goodcount));
            \Log::info('Event broadcasted: mjoinId - ' . $mjoinId . ', goodcount - ' . $goodcount);    
            return response()->json(['status' => 'false','count' => $goodcount]);
        }
    }
    //揪團讚
    public function mjoin_post_good($mjoinId)
    {
        date_default_timezone_set('Asia/Taipei');
        $username = session('user_name');
        $useremail = session('user_email');
        if(Auth::check()){
            $goodfind = UserGood::where('reply_id',$mjoinId)
                                ->where('great_code','mjoin')
                                ->where('clickgood_u',$username)
                                ->where('clickgood_e',$useremail)
                                ->first();
            if(!$goodfind){
                $good = new UserGood();
                $good->reply_id = $mjoinId;
                $good->clickgood_u = $username; // 假設你的 User 模型中有 name 欄位
                $good->clickgood_e = $useremail;
                $good->great_code = 'mjoin';
                $good->many = '1';
                $good->status = 'true';
                $good->save();

                $goodcount = UserGood::where('reply_id', $mjoinId)
                                 ->where('great_code', 'mjoin')
                                 ->where('many','1')
                                 ->count();

                broadcast(new PostGoodCountUpdated($mjoinId, $goodcount));
                
                return response()->json(['status' => 'true','count' => $goodcount]);

            } else {
                $goodfind->many =  '1'; // 根據當前的狀態更新按讚數
                $goodfind->status = 'true'; // 切換按讚狀態
                $goodfind->update();
                //event(new \App\Events\click_good($reply_id,$great_code));
                
                $goodcount = UserGood::where('reply_id', $mjoinId)
                                 ->where('great_code', 'mjoin')
                                 ->where('many','1')
                                 ->count();

                broadcast(new PostGoodCountUpdated($mjoinId, $goodcount));
                
                return response()->json(['status' => 'true','count' => $goodcount]);
            }
            
        }else{
            return view("/");
        }
    }
    public function click_good($reply_id,$great_code)
    {
        date_default_timezone_set('Asia/Taipei');
        if(Auth::check()){
            $user = Auth::user(); // 取得當前登入的用戶

            $good_check = UserGood::where('reply_id', $reply_id)
                                  ->where('great_code', $great_code)
                                  ->first();

            if(!$good_check){
                // 如果沒有按過讚，則新增一條按讚記錄
                $good = new UserGood();
                $good->reply_id = $reply_id;
                $good->clickgood_u = $user->username; // 假設你的 User 模型中有 name 欄位
                $good->clickgood_e = $user->email;
                $good->great_code = $great_code;
                $good->many = '1';
                $good->status = 'true';
                $good->save();
                //觸發事件
                //event(new \App\Events\click_good($reply_id,$great_code));
                return response()->json(['liked' => $good->status]);
            } else {
                // 如果按過讚，則更新按讚記錄
                $good_check->many = $good_check->status == 'false' ? '1' : '0'; // 根據當前的狀態更新按讚數
                $good_check->status = $good_check->status == 'false' ? 'true' : 'false'; // 切換按讚狀態
                $good_check->update();
                //event(new \App\Events\click_good($reply_id,$great_code));
                
                return response()->json(['liked' => $good_check->status]);
            }

            // 回應一些訊息，例如按讚成功或取消按讚成功
            //return response()->json(['message' => 'Success']);
            //return redirect()->route('arkwork_solo', ['ark_id' => $reply_id]);
            
        } else {
            // 如果用戶未登入，你可以回傳一個錯誤訊息或重定向到登入頁面
            return response()->json(['message' => 'Please log in']);
        }
    }
}