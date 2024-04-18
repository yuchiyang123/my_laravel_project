<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User_collecttions_artwork;
use App\Models\User_collecttions_mjoin;
use App\Models\User_collecttions_shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class UserCollectionsController extends Controller
{
    public function collection_artwork($article_id){
        $user = Auth::user();
        if($user) {
            $user_id = $user->id;
            //有無找到數據 
            $ucas = User_collecttions_artwork::where('article_id',$article_id)
                                                                ->where('user_id',$user_id)
                                                                ->first();
            if(!$ucas){
                $ucas->user_id = $user_id;
                $ucas->article_id = $article_id;
                $ucas->status = '1';
                $ucas->save();
                return redirect()->route('arkwork_solo',["art_id" =>$article_id ]);
            } else {
                if($ucas->status = '0'){
                    $ucas->status = '1';
                    $ucas->update();
                    return redirect()->route('arkwork_solo',["art_id" =>$ucas->article_id ]);
                } else {
                    $ucas->status = '0';
                    $ucas->update();
                    return redirect()->route('arkwork_solo',["art_id" =>$ucas->article_id ]);
                }
            }
        } else {
            return redirect()->route('login')->with('error','請登入再執行動作');
        }
    }

    public function collection_mjoin($article_id){
        $user = Auth::user();
        if($user) {
            $user_id = $user->id;
            //有無找到數據 
            $ucas = User_collecttions_mjoin::where('article_id',$article_id)
                                                                ->where('user_id',$user_id)
                                                                ->first();
            if(!$ucas){
                $ucas->user_id = $user_id;
                $ucas->article_id = $article_id;
                $ucas->status = '1';
                $ucas->save();
                return redirect()->route('arkwork_solo',["art_id" =>$article_id ]);
            } else {
                if($ucas->status = '0'){
                    $ucas->status = '1';
                    $ucas->update();
                    return redirect()->route('arkwork_solo',["art_id" =>$ucas->article_id ]);
                } else {
                    $ucas->status = '0';
                    $ucas->update();
                    return redirect()->route('arkwork_solo',["art_id" =>$ucas->article_id ]);
                }
            }
        } else {
            return redirect()->route('login')->with('error','請登入再執行動作');
        }
    }

    public function collection_shop($article_id){
        $user = Auth::user();
        if($user) {
            $user_id = $user->id;
            //有無找到數據 
            $ucas = User_collecttions_artwork::where('article_id',$article_id)
                                                                ->where('user_id',$user_id)
                                                                ->first();
            if(!$ucas){
                $ucas->user_id = $user_id;
                $ucas->article_id = $article_id;
                $ucas->status = '1';
                $ucas->save();
                return response()->json(['status' => 'OK']);
            } else {
                if($ucas->status = '0'){
                    $ucas->status = '1';
                    $ucas->update();
                    return response()->json(['status' => 'OK']);
                } else {
                    $ucas->status = '0';
                    $ucas->update();
                    return response()->json(['status' => 'OK']);
                }
            }
        } else {
            return redirect()->route('login')->with('error','請登入再執行動作');
        }
    }
}