<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\UserPostWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use App\Models\Shop_join;
use App\Models\ShopReply;


class UserWorkController extends Controller
{
    //顯示全部打工貼文
    public function work()
    {
        $shops = DB::table('shop')
                               ->select('shop.*', 'user_collections_shop.status as status_b', 'user.profileImage_type', 'user.profileImage')
                               ->leftJoin('user_collections_shop', 'shop.id', '=', 'user_collections_shop.article_id')
                               ->leftJoin('user', 'shop.posted_by_u', '=', 'user.username')
                               ->orderBy('shop.id', 'desc')
                               ->where('shop.status', '<>', 'del')
                               ->distinct()
                               ->get();
        return view('auth.work', compact('shops'));
    }
    //揪團刪除
    public function shop_post_delete($shopId)
    {
        if(Auth::check()){
            $shopdel = UserPostWork::where('id',$shopId)
                                       ->first();
            if(session('user_name')===$shopdel->posted_by_u){
                $status = 'del';
                $shopdel->status = $status;
                $shopdel->update();
                return redirect()->route('front');
            }
        }else{
            return view('/');
        }
    }
    //揪團編輯
    public function shop_post_edit(Request $request,$shopId)
    {
        if(Auth::check()){
            $shopedits = UserPostWork::where('id',$shopId)
                                         ->first();
            if(session('user_name')===$shopedits->posted_by_u){
                $post = UserPostWork::find($shopId);
                //時間tw
                date_default_timezone_set('Asia/Taipei');
                $title = $request->input('title');
                $destination = $request->input('destination');
                $time = $request->input('time');
                $diffDay = $request->input('diffDay');
                $people = $request->input('people');
                $money = $request->input('money');
                $sex = $request->input('sex');
                $skill = $request->input('skill');
                $age = $request->input('age');
                $description = $request->input('editor');
                
                $post->title = $title;
                $post->destination = $destination;
                $post->time = $time;
                $post->diffDay = $diffDay;
                $post->people = $people;
                $post->money = $money;
                $post->sex = $sex;
                $post->skill = $skill;
                $post->age = $age;
                $post->description = $description;
                $post->update();
                return redirect()->Route('front');
            } else {
                return view('/');
            }   
            
            
        }else{
            return view('/');
        }
    }
    //揪團編輯表單
    public function shop_edit($shopId)
    {
        if(Auth::check()){
            $shopedits = UserPostWork::where('id',$shopId)
                                         ->first();
            if(session('user_name')===$shopedits->posted_by_u){
                return view('auth.shopform_edit', compact('shopedits'));
            } else {
                return redirect()->route('error');
            }   
            
            
        }else{
            return view('/');
        }
        
    }

    //留言送出
    public function shop_reply_submit(Request $request, $shopId)
    {
        if ($request->has('messageTextarea')) {
            date_default_timezone_set('Asia/Taipei');
            $main = $request->input('messageTextarea');
            $count = ShopReply::where('reply_id', $shopId)->count();
            $reply = new ShopReply();
            
            $reply->reply_id = $shopId;
            $reply->name_e = session('user_email');
            $reply->name_u = session('user_name');
            $reply->main = $main;
            $reply->good = 0;
            $reply->status = "pending";
            $level = ($count == 0) ? 1 : ($count + 1);
            $reply->level = $level;
            $reply->save();

            // 如果需要返回一些数据给前端，可以使用 JSON 格式
            return response()->json(['success' => true, 'message' => '留言成功']);
        } else {
            // 如果回复内容为空，则返回错误消息给前端
            return response()->json(['success' => false, 'message' => '留言内容不能为空']);
        }
    }

    public function shop_reply_count($shopId){
        
        $count = ShopReply::where('reply_id', $shopId)->count();
        $count_replys = '
            <div>
                <a href="#">'.$count.'則留言</a>
            </div>';
        return response()->json(['htmlContent_reply' => $count_replys]);
    }
    //顯示單獨貼文
    public function user_shop_solo($shopId)
    {
        $shop = DB::table('shop')
                               ->select('shop.*', 'user_collections_shop.status as status_b', 'user.profileImage_type', 'user.profileImage')
                               ->leftJoin('user_collections_shop', 'shop.id', '=', 'user_collections_shop.article_id')
                               ->leftJoin('user', 'shop.posted_by_u', '=', 'user.username')
                               ->orderBy('shop.id', 'desc')
                               ->where('shop.status', '<>', 'del')
                               ->where('shop.id', $shopId)
                               ->distinct()
                               ->first();
        return view('auth.shop_solo', compact('shop'));
    }

    //回復顯示(2)
    public function shop_reply($shopId)
    {
        date_default_timezone_set('Asia/Taipei');
        //$shop_replys = shop_reply::where('reply_id', $shopId)->get();
        $shop_replys = DB::table('reply')
                            ->select('reply.*','user.profileImage_type','user.profileImage','user.profileImage_type')
                            ->leftjoin('user','reply.name_u','=','user.username')
                            ->where('reply.reply_id', $shopId)
                            ->orderBy('reply.created_at','asc')
                            ->get();
        //IF回復為0
        $shop_replys_count = ShopReply::where('reply_id', $shopId)
                                         ->count();

        $htmlContent = '<div class="SeeAllMessage">
                        <a href="#" data-shop-id="'.$shopId.'" onclick="showPopup('.$shopId.')">查看全部留言</a>
                        </div>';
                     
        if($shop_replys_count === 0){
            $htmlContent = '
            <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                <h2>無留言</h2>
            </div>';
        }else{
            $last_two_replies = $shop_replys->take(-2);
            foreach ($last_two_replies as $shop_reply) {
                // 時˙間差
                $postTime = Carbon::parse($shop_reply->created_at);
                $currentTime = Carbon::now();
                $timeDifference = $currentTime->diffForHumans($postTime);
                $imageDataUri = 'data:' . $shop_reply->profileImage_type  . ';base64,' . base64_encode( $shop_reply->profileImage );
                // 生成HTML内容
                $htmlContent .= '
                    <div class="LeaveMessage">
                        <div>
                            <div class="LeaveMessageimgdiv">';
                $htmlContent .= '
                                <a href="/user-profile/index/d/' . $shop_reply->name_u . '">';
                $htmlContent .= ($shop_reply->profileImage != null) ? 
                                '<img src="' . $imageDataUri . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">' :
                                '<img src="https://github.com/mdo.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">';
                $htmlContent .= '</a>';
                $htmlContent .= '
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    <a href="/user-profile/index/d/' . $shop_reply->name_u . '">' . $shop_reply->name_u . '</a>
                                </div>
                                <div class="LeaveMessageMain">
                                    ' . $shop_reply->main . '
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">' . $timeDifference . '</a>&emsp;<a href="#">' . $shop_reply->good .
                                    '讚</a>&emsp;<a href="' . $shop_reply->level . $shop_reply->reply_id . '">回復</a>
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    
        }
        
        return response()->json(['htmlContent' => $htmlContent]);
    }

    //全部回復顯示
    
    public function shop_reply_all($shopId)
    {
        date_default_timezone_set('Asia/Taipei');
        //$shop_replys = shop_reply::where('reply_id', $shopId)->get();
        $shop_replys = DB::table('reply')
                            ->select('reply.*','user.profileImage_type','user.profileImage')
                            ->leftjoin('user','reply.name_u','=','user.username')
                            ->where('reply.reply_id', $shopId)
                            ->orderBy('reply.created_at','asc')
                            ->get();
        //IF回復為0
        $shop_replys_count = ShopReply::where('reply_id', $shopId)
                                         ->count();

        $htmlContent = '<div class="SeeAllMessage"></div>';
                     
        if($shop_replys_count === 0){
            $htmlContent = '
            <div class="LeaveMessage" style="text-align:center;width:auto;display:inline-block;">
                <h2>無留言</h2>
            </div>';
        }else{
            //$last_two_replies = $shop_replys->take(-2);
            foreach ($shop_replys as $shop_reply) {
                // 時˙間差
                $postTime = Carbon::parse($shop_reply->created_at);
                $currentTime = Carbon::now();
                $timeDifference = $currentTime->diffForHumans($postTime);
                $imageDataUri = 'data:' . $shop_reply->profileImage_type  . ';base64,' . base64_encode( $shop_reply->profileImage );
                // 生成HTML内容
                $htmlContent .= '
                    <div class="LeaveMessage">
                        <div>
                            <div class="LeaveMessageimgdiv">';
                $htmlContent .= '
                                <a href="/user-profile/index/d/' . $shop_reply->name_u . '">';
                $htmlContent .= ($shop_reply->profileImage != null) ? 
                                '<img src="' . $imageDataUri . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">' :
                                '<img src="https://github.com/mdo.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">';
                $htmlContent .= '</a>';
                $htmlContent .= '
                            </div>
                            <div class="LeaveMessageall">
                                <div class="LeaveMessageUsername">
                                    <a href="/user-profile/index/d/' . $shop_reply->name_u . '">' . $shop_reply->name_u . '</a>
                                </div>
                                <div class="LeaveMessageMain">
                                    ' . $shop_reply->main . '
                                </div>
                                <div class="LeaveMessageAction">
                                    <a href="#">' . $timeDifference . '</a>&emsp;<a href="#">' . $shop_reply->good .
                                    '讚</a>&emsp;<a href="' . $shop_reply->level . $shop_reply->reply_id . '">回復</a>
                                </div>
                            </div>
                        </div>
                    </div>';

            }
    
        }
        
        return response()->json(['htmlContent' => $htmlContent]);
    }


    //單一揪團顯示
    public function showallshop($shopId)
    {
        //$allshop = UserPostWork::where('id', $shopId)->first();
        $allshop = DB::table('shop')
                        ->select('shop.*','user.profileImage_type','user.profileImage')
                        ->leftjoin('user','shop.posted_by_u','=','user.username')
                        ->where('shop.id', $shopId)
                        ->first();
        //套用上面的方法回復顯示
        $shopReplyHtml = $this->shop_reply($shopId);
        $shopReplyContent = json_decode($shopReplyHtml->getContent(), true)['htmlContent'];
        $imageData = 'data:' . $allshop->profileImage_type  . ';base64,' . base64_encode( $allshop->profileImage );
        $imageDatayou = 'data:' . Auth::User()->profileImage_type  . ';base64,' . base64_encode( Auth::User()->profileImage );
        $htmlContent = 
    '<div class="cut">
        <div class="grid-item">
            <div class="limt">
                <div class="image-container">
                    <a href="/user-profile/index/d/'.$allshop->posted_by_u.'">
                        <img src="' . ($allshop->profileImage ? $imageData : 'https://github.com/mdo.png') . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">
                    </a>
                </div>
                <div class="text-container">
                    <div class="user">
                        '.$allshop->posted_by_u.'
                    </div>
                    <div class="date">
                        <!--貼文日期-->
                        '.$allshop->date.'
                    </div>
                </div>
                <div class="post_condition fw-bolder border-bottom border-top pt-2 pb-2 mt-1 mb-1 d-flex flex-row bd-highlight text-break" style="font-size: 14px;">
                    <label class="flex-fill ps-3">日期:'.$allshop->time.'</label>
                    <label class="flex-fill">人數:'.$allshop->people.'</label>
                    <label class="flex-fill">預算:'.$allshop->money.'</label>
                    <label class="flex-fill">性別:'.$allshop->sex.'</label>
                    <label class="flex-fill">需要技能:'.$allshop->skill.'</label>
                    <label class="flex-fill pe-3">年齡:'.$allshop->age.'</label>
                </div>
                <div class="clearfix"></div>
                <div class="main image-container text-start">
                    '. $allshop->description.'
                </div>
                <div class="container">
                    <div class="respond">
                        <a href="#">👍🏽</a>
                        <div>
                            <a href="#">0</a>
                        </div>
                    </div>
                    <div class="message">
                        <div>
                            <a href="#">8則留言</a>
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="inner-grid">@yield("PostAcion1")</div>
                    <div class="inner-grid">@yield("PostAcion2")</div>
                    <div class="inner-grid">@yield("PostAcion3")</div>
                </div>
                <div class="ShowAllMessageall" id="showAllMessageall_'.$shopId.'">

                </div>
                <div class="LeaveMessageInput flex-row">
                            <div class="LeaveMessageInputrpAname p-2">';
            
            $htmlContent .= (Auth::User()->profileImage != null) ? 
                            '<img src="' . $imageDatayou  . '" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">' :
                            '<img src="https://github.com/mdo.png" class="img-fluid avatar-xxl rounded-circle" style="width: 40px;" alt="">';
            $htmlContent .= '</div>
                            <div class="p-2">
                                <textarea class="form-control" placeholder="留言" id="messageTextarea_'.$shopId.'" name="messageTextarea_'.$shopId.'" rows="1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submitReply" onclick="submitReply('.$shopId.')">留言</button>
                        </div>';
                
        return response()->json(['htmlContent' => $htmlContent]);
    }


    //發文
    public function work_post(Request $request){
        if(Auth::check()){
            if($request->has('editor')) {
                $senderu = session('user_name');
                $sendere = session('user_email');
                $post = new UserPostWork();

                
                //時間tw
                date_default_timezone_set('Asia/Taipei');
                $shop_name = $request->input('shop_name');
                $selectwhere = $request->input('selectwhere');
                $business_registration_number = $request->input('business_registration_number');
                $location = $request->input('location');
                $driver_license_requirements = $request->input('driver_license_requirements');
                $recruitment_period = $request->input('recruitment_period');
                $sex = $request->input('sex');
                $languages = $request->input('languages');
                $conditions_exp = $request->input('conditions_exp');
                $work_hours = $request->input('work_hours');
                $job_description = $request->input('job_description');
                $benefits = $request->input('benefits');
                $shop_information = $request->input('editor');
                
                //陣列轉字串
                 // 從表單中獲取多選框的值
                $languageString = implode(',', $languages); // 將陣列中的值用逗號分隔合併成字串
                $job_descriptionString = implode(',', $job_description);
                $benefitsString = implode(',', $benefits);

                $post->shop_name = $shop_name;
                $post->selectwhere = $selectwhere;
                $post->business_registration_number = $business_registration_number;
                $post->location = $location;
                $post->driver_license_requirements = $driver_license_requirements;
                $post->recruitment_period = $recruitment_period;
                $post->sex = $sex;
                $post->language = $languageString;
                $post->conditions_exp = $conditions_exp;
                $post->work_hours = $work_hours;
                $post->job_description = $job_descriptionString;
                $post->benefits = $benefitsString;
                $post->shop_information = $shop_information;
                $post->senderu = $senderu;
                $post->sendere = $sendere;
                $post->status = "pending";
                $post->save();
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        } 
    }
}