<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGoodArtwork;
use Carbon\Carbon;
use App\Events\PostGoodCountUDARK;


class UserGoodArkController extends Controller
{
    //創作讚數
    public function ark_post_countgood($article_id)
    {
        $goodcount = UserGoodArtwork::where('article_id', $article_id)
                             ->where('status','1')
                             ->count();
        return response()->json(['count' => $goodcount]);
    }

    //創作讚讚檢查
    public function ark_post_checkgood($article_id)
    {
        date_default_timezone_set('Asia/Taipei');
        $user_id = Auth::user();
        $goodcheck = UserGoodArtwork::where('article_id',$article_id)
                             ->where('user_id',$user_id->id)
                             ->first();
        if(!$goodcheck || $goodcheck->status==0){
            return response()->json(['status' => 'false']);
        } else {
            return response()->json(['status' => 'true']);
        }
    }

    //揪團取消讚
    public function ark_post_ungood($article_id)
    {
        date_default_timezone_set('Asia/Taipei');
        $user_id = Auth::user();
        if(Auth::check()){
            $goodfind = UserGoodArtwork::where('article_id',$article_id)
                                ->where('user_id',$user_id->id)
                                ->first();
            dd($goodfind);
                $goodfind->status = '0'; // 切換按讚狀態
                $goodfind->update();
                
            $goodcount = UserGoodArtwork::where('article_id', $article_id)
                                 ->where('status','1')
                                 ->count();

            broadcast(new PostGoodCountUDARK($article_id, $goodcount));
            return response()->json(['status' => 'false','count' => $goodcount]);
        }
    }
    //揪團讚
    public function ark_post_good($article_id)
    {
        date_default_timezone_set('Asia/Taipei');
        $user_id = Auth::user();
        if(Auth::check()){
            $goodfind = UserGoodArtwork::where('article_id',$article_id)
                                ->where('user_id',$user_id->id)
                                ->first();
            if(!$goodfind){
                $good = new UserGoodArtwork();
                $good->article_id = $article_id;
                $good->user_id = $user_id->id;
                $good->status = '1';
                $good->save();

                $goodcount = UserGoodArtwork::where('article_id', $article_id)
                                 ->where('status','1')
                                 ->count();

                broadcast(new PostGoodCountUDARK($article_id, $goodcount));
                return response()->json(['status' => 'true','count' => $goodcount]);

            } else {
                $goodfind->status = '1'; // 切換按讚狀態
                $goodfind->update();
                //event(new \App\Events\click_good($reply_id,$great_code));
                
                $goodcount = UserGoodArtwork::where('article_id', $article_id)
                                 ->where('status','1')
                                 ->count();

                broadcast(new PostGoodCountUDARK($article_id, $goodcount));
                return response()->json(['status' => 'true','count' => $goodcount]);
            }
            
        }else{
            return view("/");
        }
    }
}