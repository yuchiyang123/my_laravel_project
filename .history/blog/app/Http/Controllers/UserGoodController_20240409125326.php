<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGood;

class UserGoodController extends Controller
{
    public function click_good(Request $request, Post $post , $reply_id,$great_code)
    {
        if(Auth::check()){
            date_default_timezone_set('Asia/Taipei');
            $user_name = session('user_name');
            $user_email = session('user_email');
            $good_check = UserGood::where('reply_id' , $reply_id)
                              ->where('great_code' , $great_code)
                              ->first();
            if(!$good_check){
                //沒按過讚
                $good = new UserGood();
                $good->reply_id = $reply_id;
                $good->clickgood_u = $user_name;
                $good->clickgood_e = $user_email;
                $good->great_code = $great_code;
                $good->many = '1';
                $good->status = 'true';
                $good->save();
            } else {
                if( $good_check->status == 'false' ){
                    //有按過讚但是取消了
                    $good = new UserGood();
                    $good->many = '1';
                    $good->status = 'true';
                    $good->update();
                } else {
                    //要取消讚的
                    $good = new UserGood();
                    $good->many = '0';
                    $good->status = 'false';
                    $good->update();
                }
            }
        }else{

        }
        
    }
}
