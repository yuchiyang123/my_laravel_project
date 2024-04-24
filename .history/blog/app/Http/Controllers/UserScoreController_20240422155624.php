<?php

namespace App\Services;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Auth\SendActionLink;
use Kreait\Firebase\Auth\SendActionLink\RawOobCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\UserPostArkwork;
use App\Models\Artwork_reply;
use Illuminate\Http\Request;
use App\Models\UserGood;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Models\User_phone;
use App\Models\MjoinScore;
use App\Models\User_notify_mjoin;
use App\Models\User_join_mjoin;
use App\Models\UserPostMjoin;


use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class UserScoreController extends Controller
{
    public function score_form($mjoin)
    {
        //確定加入且審核過的 確認加入是否有人
        // 确定加入且审核通过的用户
        $join_members = User_join_mjoin::where('article_id', $mjoin)
                                        ->where('status', 'pass')
                                        ->get();
        $join_members_1 = User_join_mjoin::where('article_id', $mjoin)
                                        ->where('user_id','<>',Auth::user()->id)
                                        ->where('status', 'pass')
                                        ->get();
        $mjoin_author_1 = UserPostMjoin::where('id', $mjoin)
                                        ->where('posted_by_u','<>', Auth::user()->username)
                                        ->first();
        // 获取当前用户发布的揪團
        $mjoin_author = UserPostMjoin::where('id', $mjoin)
                                    ->where('posted_by_u', Auth::user()->username)
                                    ->get();

        // 计算加入且审核通过的用户数量
        $join_members_count = $join_members->count();
        //$mjoin_author_count = $mjoin_author->count();
        // 检查是否有当前用户发布的揪團
        //$is_author = !is_null($mjoin_author);

        // 计算结果相加
        $total = $join_members_count + 1;

        //dd($join_members_1,$mjoin_author_1);
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        if($total < 2){
            // 如果用户数量不足以进行评分，返回视图时传递错误消息
            return redirect('/error')->with('error', '一人不能評分拉');
        }
        return view('auth.score_form', compact('mjoin_author_1', 'join_members_1'));
    }
}