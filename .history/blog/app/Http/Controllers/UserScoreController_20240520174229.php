<?php

namespace App\Services;
namespace App\Http\Controllers;

use Carbon\Carbon;
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
use App\Models\WorkScore;
use App\Models\Shop_join;
use App\Models\UserPostWork;

use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class UserScoreController extends Controller
{
    public function score_form($mjoin)
    {
        //確定加入且審核過的 確認加入是否有人
        // 确定加入且审核通过的用户
        $join_members = User_join_mjoin::where('article_id', $mjoin)
                                        
                                        ->whereIn('status', ['pass','complete'])
                                        ->get();
        $join_members_1 = User_join_mjoin::where('article_id', $mjoin)
                                        
                                        ->whereIn('status', ['pass', 'complete'])
                                        ->get();
                                    
        $mjoin_author_1 = UserPostMjoin::where('id', $mjoin)
                                        ->first();
        // 获取当前用户发布的揪團
        $mjoin_author = UserPostMjoin::where('id', $mjoin)
                                    ->first();

        // 计算加入且审核通过的用户数量
        $join_members_count = $join_members->count();
        //$mjoin_author_count = $mjoin_author->count();
        // 检查是否有当前用户发布的揪團
        //$is_author = !is_null($mjoin_author);

        // 计算结果相加
        $total = $join_members_count + 1;
        //dd($total);
        //dd($join_members,$mjoin);
        //dd($join_members_1,$mjoin_author_1);
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        $dates = explode(' - ', $mjoin_author_1->time);

                        // 将开始日期和结束日期转换为 Carbon 实例
        $end_date = Carbon::parse($dates[1]);
        $current_time = Carbon::now();
        if($current_time<$end_date){
            return redirect('/front')->with('error', '招募時間還沒過，還不能評分');
        }
        if($mjoin_author_1->status == 'del'){
            return redirect('/front')->with('error', '此招募已刪除');
        }
        if($total < 2){
            // 如果用户数量不足以进行评分，返回视图时传递错误消息
            return redirect('/error')->with('error', '一人不能評分拉');
        }
        if($mjoin_author->status == 'complete'){
            return redirect('/front')->with('error', '請勿重複評分');
        }
        return view('auth.score_form', compact('mjoin_author_1', 'join_members_1'));
    }

    public function score_form_submit(Request $request, $mjoin)
    {
        //dd($request);
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        $feedbackData = $request->input('feedback');
        $commentsData = $request->input('comments');
        //dd($feedbackData);
        if (!is_null($feedbackData) && is_array($feedbackData)) {
            foreach ($feedbackData as $userId => $feedback) {
                // 创建 Feedback 模型实例
                $feedbackModel = new MjoinScore();
                $feedbackModel->rater_id = Auth::user()->id; // 评分者 ID
                $feedbackModel->evaluated_id = $userId; 
                $feedbackModel->article_id = $mjoin; // 用户 ID
                $feedbackModel->score = $feedback; // 评分
    
                // 如果有评论，则保存评论
                if (isset($commentsData[$userId])) {
                    $feedbackModel->comments = $commentsData[$userId];
                }
                $feedbackModel->status = 'pending'; // 评分状态

                   
                // 保存到数据库
                $feedbackModel->save();
                $mjoin_author = UserPostMjoin::where('id', $mjoin)->first();
                if($mjoin_author->posted_by_u != Auth::user()->username){
                    $update_join_mjoin = User_join_mjoin::where('user_id', Auth::user()->id)->where('article_id', $mjoin)->first();
                    $update_join_mjoin->status = 'complete';
                    $update_join_mjoin->update();
                    $update_join_mjoin_notify = User_notify_mjoin::where('user_id', Auth::user()->id)->where('article_id', $mjoin)->first();
                    $update_join_mjoin_notify->status = 'complete';
                    $update_join_mjoin_notify->update();
                } else {
                    $mjoin_author->status = 'complete';
                    $mjoin_author->update();
                }

            }
            return redirect()->route('success')->with('success', '評分成功');
        }
        // 循环处理每个用户的评分和评论
        //return redirect()->route('success')->with('success', '評分成功');
    }

    //打工評分
    public function shop_score_form($joinId)
    {
        $shop_check = UserPostWork::where('id',$joinId)->first();
        //確定加入且審核過的 確認加入是否有人
        // 确定加入且审核通过的用户
        $dates = explode(' - ', $shop_check->recruitment_period);

                        // 将开始日期和结束日期转换为 Carbon 实例
        $end_date = Carbon::parse($dates[1]);
        $current_time = Carbon::now();
        if($current_time<$end_date){
            return redirect('/work')->with('error', '招募時間還沒過，還不能評分');
        }
        $join_members = Shop_join::where('article_id', $joinId)
                                        ->where('status', 'pass')
                                        ->get();
        $join_members_1 = Shop_join::where('article_id', $joinId)
                                        ->where('user_id','<>',Auth::user()->id)
                                        ->where('status', 'pass')
                                        ->get();
        $shop_author_1 = UserPostWork::where('id', $joinId)
                                        ->where('posted_by_u','<>', Auth::user()->username)
                                        ->first();
        // 获取当前用户发布的揪團
        $shop_author = UserPostWork::where('id', $joinId)
                                    ->where('posted_by_u', Auth::user()->username)
                                    ->get();
        if($shop_check->posted_by_u == Auth::user()->username){
            return redirect('/work')->with('error', '目前店家不能評分');
        }
        

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
            return redirect('/work')->with('error', '你已經評分過了');
        }
        return view('auth.shop_score_form', compact('shop_author_1', 'join_members_1'));
    }

    public function shop_score_form_submit(Request $request, $joinId)
    {
        //dd($request);
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        $feedbackData = $request->input('feedback');
        $commentsData = $request->input('comments');
        //dd($feedbackData);
        if (!is_null($feedbackData) && is_array($feedbackData)) {
            foreach ($feedbackData as $userId => $feedback) {
                // 创建 Feedback 模型实例
                $feedbackModel = new WorkScore();
                $feedbackModel->rater_id = Auth::user()->id; // 评分者 ID
                $feedbackModel->evaluated_id = $userId; 
                $feedbackModel->article_id = $joinId; // 用户 ID
                $feedbackModel->score = $feedback; // 评分
    
                // 如果有评论，则保存评论
                if (isset($commentsData[$userId])) {
                    $feedbackModel->comments = $commentsData[$userId];
                }
                $feedbackModel->status = 'pending'; // 评分状态

                   
                // 保存到数据库
                $feedbackModel->save();
                $update_join_shop = Shop_join::where('user_id', Auth::user()->id)->where('article_id', $joinId)->first();
                $update_join_shop->status = 'complete';
                $update_join_shop->update();
                
            }
            return redirect()->route('success')->with('success', '評分成功');
        }
        // 循环处理每个用户的评分和评论
        //return redirect()->route('success')->with('success', '評分成功');
    }
}