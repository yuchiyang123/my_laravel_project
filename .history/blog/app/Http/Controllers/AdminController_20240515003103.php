<?php

namespace App\Services;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
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
use App\Models\Shop_apply;
use App\Models\User_notify_mjoin;
use App\Models\User_join_mjoin;
use App\Models\UserPostMjoin;
use App\Models\WorkScore;
use App\Models\Shop_join;
use App\Models\User_profile_public;
use App\Models\UserPostWork;
use App\Models\UserProfile;
use App\Models\UserStop;
use App\Models\Notify;
use AWS\CRT\HTTP\Response;

use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class AdminController extends Controller
{
    public function admin_login()
    {
        return view('admin.admin_login');
    }
    public function admin_index()
    {
        return view('admin.index2');
    }
    public function admin_login_submit(Request $request)
    {
        $data = $request->all();
        if(Auth::attempt(['username' => $data['username'], 'password' => $data['password']])){
            return redirect()->route('admin_index');
        }else{
            return redirect()->route('admin_login');
        }
    }

    public function admin_logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin_login');
        
    }
    public function user_auth()
    {
        $users = User::leftJoin('user_phone', 'user.id', '=', 'user_phone.user_id')
              ->select('user.*', 'user_phone.phone')
              ->get();
        //$user_phone = User_phone::where('user_id',$users)->get();
        return view('admin.user_auth',compact('users'));
    }
    public function user_cms(Request $request)
    {
        $mjoins = UserPostMjoin::all();
        $shops = UserPostWork::all();
        $artworks = UserPostArkwork::all();
        $artworks->transform(function ($artwork) {
            $user = User::find($artwork->user_id);
            $artwork->username = $user ? $user->username : 'N/A';
            return $artwork;
        });
        return view('admin.user_cms',compact('mjoins','shops','artworks'));
    }
    //加入
    public function user_join()
    {
        // 獲取所有的 UserPostMjoin
        $mjoins = UserPostMjoin::all();

        // 定義一個空陣列用於存儲加入者的頭像資訊
        $joiners = [];

        // 遍歷每一篇文章，查詢其加入者
        foreach ($mjoins as $mjoin) {
            // 查詢這篇文章的加入者
            $joiners[$mjoin->id] = User_join_mjoin::where('article_id', $mjoin->id)->get();

            // 遍歷這篇文章的加入者
            foreach ($joiners[$mjoin->id] as $joiner) {
                // 查詢加入者的用戶信息
                $user = User::find($joiner->user_id);

                // 如果找到了用戶
                if ($user) {
                    // 設置用戶名
                    $joiner->username = $user->username;
                    // 設置用戶頭像相對路徑
                    $joiner->profile_image = $user->profileImage;
                    // 設置用戶頭像類型
                    $joiner->profile_image_type = $user->profileImage_type;
                    // 如果頭像路徑存在，則組合成完整的 URL
                    if ($joiner->profile_image) {
                        $joiner->profile_image_url = 'data:' . $joiner->profile_image_type . ';base64,' . base64_encode($joiner->profile_image);
                    } else {
                        // 如果頭像路徑不存在，設置為默認頭像的 URL
                        $joiner->profile_image_url = 'https://github.com/mdo.png';
                    }
                } else {
                    // 如果未找到用戶，設置用戶名為 N/A
                    $joiner->username = 'N/A';
                    // 設置頭像路徑為 null
                    $joiner->profile_image = null;
                    // 設置頭像類型為 null
                    $joiner->profile_image_type = null;
                    // 設置頭像 URL 為默認頭像的 URL
                    $joiner->profile_image_url = 'https://github.com/mdo.png';
                }
            }
        }

        // 遍歷每一篇文章，查詢其作者的頭像資訊
        $mjoins->transform(function ($mjoin) {
            // 查詢用戶信息
            $user = User::find($mjoin->posted_by_u);
            // 如果找到了用戶
            if ($user) {
                // 設置用戶名
                $mjoin->username = $user->username;
                // 設置用戶頭像相對路徑
                $mjoin->profile_image = $user->profileImage;
                // 設置用戶頭像類型
                $mjoin->profile_image_type = $user->profileImage_type;
                // 如果頭像路徑存在，則組合成完整的URL
                if ($mjoin->profile_image) {
                    $mjoin->profile_image_url = 'data:' . $mjoin->profile_image_type . ';base64,' . base64_encode($mjoin->profile_image);
                } else {
                    // 如果頭像路徑不存在，設置為默認頭像的URL
                    $mjoin->profile_image_url = 'https://github.com/mdo.png';
                }
            } else {
                // 如果未找到用戶，設置用戶名為 N/A
                $mjoin->username = 'N/A';
                // 設置頭像路徑為 null
                $mjoin->profile_image = null;
                // 設置頭像類型為 null
                $mjoin->profile_image_type = null;
                // 設置頭像URL為默認頭像的URL
                $mjoin->profile_image_url = 'https://github.com/mdo.png';
            }
            return $mjoin;
        });
        //dd($joiners,$mjoins);
        // 將所有處理好的資料傳遞到視圖中

        $shops = UserPostWork::all();

        // 定義一個空陣列用於存儲加入者的頭像資訊
        $shop_joiners = [];

        // 遍歷每一篇文章，查詢其加入者
        foreach ($shops as $shop) {
            // 查詢這篇文章的加入者
            $shop_joiners[$shop->id] = Shop_join::where('article_id', $shop->id)->get();

            // 遍歷這篇文章的加入者
            foreach ($shop_joiners[$shop->id] as $shop_joiner) {
                // 查詢加入者的用戶信息
                $user = User::find($shop_joiner->user_id);

                // 如果找到了用戶
                if ($user) {
                    // 設置用戶名
                    $shop_joiner->username = $user->username;
                    // 設置用戶頭像相對路徑
                    $shop_joiner->profile_image = $user->profileImage;
                    // 設置用戶頭像類型
                    $shop_joiner->profile_image_type = $user->profileImage_type;
                    // 如果頭像路徑存在，則組合成完整的 URL
                    if ($shop_joiner->profile_image) {
                        $shop_joiner->profile_image_url = 'data:' . $shop_joiner->profile_image_type . ';base64,' . base64_encode($shop_joiner->profile_image);
                    } else {
                        // 如果頭像路徑不存在，設置為默認頭像的 URL
                        $shop_joiner->profile_image_url = 'https://github.com/mdo.png';
                    }
                } else {
                    // 如果未找到用戶，設置用戶名為 N/A
                    $shop_joiner->username = 'N/A';
                    // 設置頭像路徑為 null
                    $shop_joiner->profile_image = null;
                    // 設置頭像類型為 null
                    $shop_joiner->profile_image_type = null;
                    // 設置頭像 URL 為默認頭像的 URL
                    $shop_joiner->profile_image_url = 'https://github.com/mdo.png';
                }
            }
        }

        // 遍歷每一篇文章，查詢其作者的頭像資訊
        $shops->transform(function ($shop) {
            // 查詢用戶信息
            $user = User::find($shop->posted_by_u);
            // 如果找到了用戶
            if ($user) {
                // 設置用戶名
                $shop->username = $user->username;
                // 設置用戶頭像相對路徑
                $shop->profile_image = $user->profileImage;
                // 設置用戶頭像類型
                $shop->profile_image_type = $user->profileImage_type;
                // 如果頭像路徑存在，則組合成完整的URL
                if ($shop->profile_image) {
                    $shop->profile_image_url = 'data:' . $shop->profile_image_type . ';base64,' . base64_encode($shop->profile_image);
                } else {
                    // 如果頭像路徑不存在，設置為默認頭像的URL
                    $shop->profile_image_url = 'https://github.com/mdo.png';
                }
            } else {
                // 如果未找到用戶，設置用戶名為 N/A
                $shop->username = 'N/A';
                // 設置頭像路徑為 null
                $shop->profile_image = null;
                // 設置頭像類型為 null
                $shop->profile_image_type = null;
                // 設置頭像URL為默認頭像的URL
                $shop->profile_image_url = 'https://github.com/mdo.png';
            }
            return $shop;
        });
        return view('admin.user_join',compact('joiners','mjoins','shop_joiners','shops'));
    }
    //用戶參與情況
    public function user_join_status($userId)
    {
            // 獲取所有的 UserPostMjoin
        $usere = User::where('id',$userId)->first();
        $mjoins = UserPostMjoin::where('posted_by_u',$usere->username)->get();
        //dd($mjoins);
        // 定義一個空陣列用於存儲加入者的頭像資訊
        $joiners = [];

        // 遍歷每一篇文章，查詢其加入者
        foreach ($mjoins as $mjoin) {
            // 查詢這篇文章的加入者
            $joiners[$mjoin->id] = User_join_mjoin::where('article_id', $mjoin->id)->get();

            // 遍歷這篇文章的加入者
            foreach ($joiners[$mjoin->id] as $joiner) {
                // 查詢加入者的用戶信息
                $user = User::find($joiner->user_id);

                // 如果找到了用戶
                if ($user) {
                    // 設置用戶名
                    $joiner->username = $user->username;
                    // 設置用戶頭像相對路徑
                    $joiner->profile_image = $user->profileImage;
                    // 設置用戶頭像類型
                    $joiner->profile_image_type = $user->profileImage_type;
                    // 如果頭像路徑存在，則組合成完整的 URL
                    if ($joiner->profile_image) {
                        $joiner->profile_image_url = 'data:' . $joiner->profile_image_type . ';base64,' . base64_encode($joiner->profile_image);
                    } else {
                        // 如果頭像路徑不存在，設置為默認頭像的 URL
                        $joiner->profile_image_url = 'https://github.com/mdo.png';
                    }
                } else {
                    // 如果未找到用戶，設置用戶名為 N/A
                    $joiner->username = 'N/A';
                    // 設置頭像路徑為 null
                    $joiner->profile_image = null;
                    // 設置頭像類型為 null
                    $joiner->profile_image_type = null;
                    // 設置頭像 URL 為默認頭像的 URL
                    $joiner->profile_image_url = 'https://github.com/mdo.png';
                }
            }
        }

        // 遍歷每一篇文章，查詢其作者的頭像資訊
        $mjoins->transform(function ($mjoin) {
            // 查詢用戶信息
            $user = User::find($mjoin->posted_by_u);
            // 如果找到了用戶
            if ($user) {
                // 設置用戶名
                $mjoin->username = $user->username;
                // 設置用戶頭像相對路徑
                $mjoin->profile_image = $user->profileImage;
                // 設置用戶頭像類型
                $mjoin->profile_image_type = $user->profileImage_type;
                // 如果頭像路徑存在，則組合成完整的URL
                if ($mjoin->profile_image) {
                    $mjoin->profile_image_url = 'data:' . $mjoin->profile_image_type . ';base64,' . base64_encode($mjoin->profile_image);
                } else {
                    // 如果頭像路徑不存在，設置為默認頭像的URL
                    $mjoin->profile_image_url = 'https://github.com/mdo.png';
                }
            } else {
                // 如果未找到用戶，設置用戶名為 N/A
                $mjoin->username = 'N/A';
                // 設置頭像路徑為 null
                $mjoin->profile_image = null;
                // 設置頭像類型為 null
                $mjoin->profile_image_type = null;
                // 設置頭像URL為默認頭像的URL
                $mjoin->profile_image_url = 'https://github.com/mdo.png';
            }
            return $mjoin;
        });
        //dd($joiners,$mjoins);
        // 將所有處理好的資料傳遞到視圖中
        $usere = User::where('id',$userId)->first();
        $shops = UserPostWork::where('posted_by_u',$usere->username)->get();
        

        // 定義一個空陣列用於存儲加入者的頭像資訊
        $shop_joiners = [];
        
        // 遍歷每一篇文章，查詢其加入者
        foreach ($shops as $shop) {
            // 查詢這篇文章的加入者
            
            $shop_joiners[$shop->id] = Shop_join::where('article_id', $shop->id)->get();

            // 遍歷這篇文章的加入者
            foreach ($shop_joiners[$shop->id] as $shop_joiner) {
                // 查詢加入者的用戶信息
                $user = User::find($shop_joiner->user_id);

                // 如果找到了用戶
                if ($user) {
                    // 設置用戶名
                    $shop_joiner->username = $user->username;
                    // 設置用戶頭像相對路徑
                    $shop_joiner->profile_image = $user->profileImage;
                    // 設置用戶頭像類型
                    $shop_joiner->profile_image_type = $user->profileImage_type;
                    // 如果頭像路徑存在，則組合成完整的 URL
                    if ($shop_joiner->profile_image) {
                        $shop_joiner->profile_image_url = 'data:' . $shop_joiner->profile_image_type . ';base64,' . base64_encode($shop_joiner->profile_image);
                    } else {
                        // 如果頭像路徑不存在，設置為默認頭像的 URL
                        $shop_joiner->profile_image_url = 'https://github.com/mdo.png';
                    }
                } else {
                    // 如果未找到用戶，設置用戶名為 N/A
                    $shop_joiner->username = 'N/A';
                    // 設置頭像路徑為 null
                    $shop_joiner->profile_image = null;
                    // 設置頭像類型為 null
                    $shop_joiner->profile_image_type = null;
                    // 設置頭像 URL 為默認頭像的 URL
                    $shop_joiner->profile_image_url = 'https://github.com/mdo.png';
                }
            }
        }
    

        // 遍歷每一篇文章，查詢其作者的頭像資訊
        $shops->transform(function ($shop) {
            // 查詢用戶信息
            $user = User::find($shop->posted_by_u);
            // 如果找到了用戶
            if ($user) {
                // 設置用戶名
                $shop->username = $user->username;
                // 設置用戶頭像相對路徑
                $shop->profile_image = $user->profileImage;
                // 設置用戶頭像類型
                $shop->profile_image_type = $user->profileImage_type;
                // 如果頭像路徑存在，則組合成完整的URL
                if ($shop->profile_image) {
                    $shop->profile_image_url = 'data:' . $shop->profile_image_type . ';base64,' . base64_encode($shop->profile_image);
                } else {
                    // 如果頭像路徑不存在，設置為默認頭像的URL
                    $shop->profile_image_url = 'https://github.com/mdo.png';
                }
            } else {
                // 如果未找到用戶，設置用戶名為 N/A
                $shop->username = 'N/A';
                // 設置頭像路徑為 null
                $shop->profile_image = null;
                // 設置頭像類型為 null
                $shop->profile_image_type = null;
                // 設置頭像URL為默認頭像的URL
                $shop->profile_image_url = 'https://github.com/mdo.png';
            }
            return $shop;
        });
        return view('admin.user_join_status',compact('joiners','mjoins','shop_joiners','shops'));
    }

    //揪團單獨
    public function user_mjoin_solo($mjoinId)
    {
        $mjoin = UserPostMjoin::where('id',$mjoinId)->first();
        if(empty($mjoin)){
            return redirect()->route('user_cms')->with('success', '找不到資料');
        }
        
        return view('admin.user_mjoin_solo', compact('mjoin'));
    }
    //打工單獨
    public function user_shop_solo($shopId)
    {
        $shops = UserPostWork::where('id',$shopId)->first();
        if(empty($shops)){
            return redirect()->route('user_cms')->with('success', '找不到資料');
        }
        return view('admin.user_shop_solo', compact('shops'));
    }

    //單獨創作顯示
    public function user_artwork_solo($arkId)
    {
        $userarkworksolo = UserPostArkwork::select('user.username', 'artwork.*')
                                            ->leftJoin('user', 'artwork.user_id', '=', 'user.id')
                                            ->where('artwork.id', $arkId)
                                            ->first();
        if($userarkworksolo == null){
            return redirect()->route('user_cms')->with('success', '找不到資料');
        }
                                
        $userartworkreplys = Artwork_reply::where('reply_id' ,$arkId)->get();
        //全部按讚人數
        
        return view('admin.user_artwork_solo' ,compact('userarkworksolo','userartworkreplys'));
    }
    //用戶停權
    public function user_stop($userId,Request $request) 
    {
        if($userId != Auth::user()->id){
            $msg = $request->input('msg');
            $user = User::find($userId);
            $user_stop = new UserStop;
            $user_stop->user_id = $userId;
            $user_stop->message = $msg;
            $user_stop->status = 'suspension';
            $user_stop->save();
            $user->state = 'suspension';
            $user->update();
            return redirect()->route('user_auth');
        }
    }

    public function user_resume($userId) 
    {
        if($userId != Auth::user()->id){
            //$msg = $request->input('msg');
            $user = User::where('id',$userId)->first();
            //$user_stop = UserStop::where('user_id',$userId)->first();
            $user_stop = UserStop::where('user_id',$userId)->first();
            $user_stop->status = 'action';
            $user_stop->update();
            $user->state = 'action';
            $user->update();
            return redirect()->route('user_auth');
        }
    }
    //用戶資料顯示
    public function user_auth_data($userId)
    {
        $user = User::where('id',$userId)->first();
        $user_p_public = User_profile_public::where('user_id',$userId)->first();
        $user_p = UserProfile::where('user_id',$userId)->first();
        $user_phone = User_phone::where('user_id',$userId)->first();
        return view('admin.user_auth_data',compact('user_p','user','user_p_public','user_phone'));
    }
    
    //用戶資料修改
    public function user_auth_data_submit($userId,Request $request)
    {
        $user = User::where('id',$userId)->first();

        
        $user_p = UserProfile::where('user_id',$userId)->first() ? UserProfile::where('user_id', $userId)->first() : new UserProfile();

        $user_p_public = User_profile_public::where('user_id',$userId)->first() ? User_profile_public::where('user_id',$userId)->first() : new User_profile_public();
        //dd($user_p);
        // 更新用戶性別和生日
        $user->sex = $request->input('sex');
        $user->age = $request->input('age');

        $user->update();

        //更新用戶個人資料
        $user_p->self_introduction = $request->input('self_introduction');
        $user_p->social_links = $request->input('social_links');
        $user_p->social_links2 = $request->input('social_links2');
        $user_p->social_links3 = $request->input('social_links3');
        $user_p->social_links4 = $request->input('social_links4');

        $user_p->favorite_articles_visibility = $request->input('favorite_private');


        if ($user_p->exists) {
            $user_p->save();
        } else {
            $user_p->user_id = $userId;
            $user_p->save();
        }

        $user_p_public->user_age_public = $request->input('age_private');
        $user_p_public->user_sex_public = $request->input('sex_private');

        if($user_p_public->exists){
            $user_p_public->save();
        } else {
            $user_p_public->user_id = $userId; 
            $user_p_public->save();
        }
        
        return redirect()->route('user_auth_data', ['userId' => $userId])->with('success','更新成功');
    }

    public function user_auth_data_delete_profile_image($userId)
    {
        $user = User::where('id',$userId)->first();
        $user->profileImage = null;
        $user->profileImage_type = null;
        $user->update();
        return redirect()->route('user_auth_data', ['userId' => $userId])->with('success','清除成功');
    }
    //店家申請
    public function shop_apply()
    {
        $shop_applys = Shop_apply::all();
        return view('admin.shop_apply',compact('shop_applys'));
    }
    //店家單獨顯示
    public function shop_apply_solo($shopId)
    {   
        $shop_apply = Shop_apply::where('id', $shopId)->first();
        $profile_image_url = 'data:' . $shop_apply->image_type . ';base64,' . base64_encode($shop_apply->image_data);
        $profile_image_url1 = 'data:' . $shop_apply->image_type1 . ';base64,' . base64_encode($shop_apply->image_data1);
        return view('admin.shop_apply_solo',compact('shop_apply','profile_image_url','profile_image_url1'));
    }
    //審核通過
    public function shop_apply_pass($shopId)
    {
        
        $shop_apply = Shop_apply::where('id', $shopId)->first();
        if($shop_apply->status!='pending'){
            return redirect()->route('shop_apply')->with('success','已經通過');
        }
        $shop_apply->status = 'approved';
        $shop_apply->update();
        $user = User::where('id',$shop_apply->user_id)->first();
        $user->permissions = '2';
        $user->update();
        $notify = new Notify();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $shop_apply->user_id;
        $notify->main = '您的店鋪申請已經通過';
        $notify->status = 'pending';
        $notify->come_from = '店家審核';
        $notify->action = '通過';
        $notify->article_id = $shopId;
        $notify->save();
        return redirect()->route('shop_apply');
    }
    //審核拒絕
    public function shop_apply_reject($shopId,Request $request)
    {
        $shop_apply = Shop_apply::where('id', $shopId)->first();
        if($shop_apply->status!='pending'){
            return redirect()->route('shop_apply')->with('success','已經通過或是已經拒絕');
        }
        $shop_apply->status = 'reject';
        if($request->input('msg')){
            $shop_apply->msg = $request->input('msg');
        }    
        $shop_apply->update();
        $notify = new Notify();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $shop_apply->user_id;
        $notify->main = '您的店鋪申請已經被拒絕';
        $notify->status = 'pending';
        if ($request->input('msg')) {
            $notify->main .= ' 原因:' . $request->input('msg');
        }
        $notify->come_from = '店家審核';
        $notify->action = '失敗';
        $notify->article_id = $shopId;
        $notify->save();
        return redirect()->route('shop_apply');
    }
    //單獨顯示揪團編輯
    public function user_cms_mjoin_edit($mjoinId)
    {
        $mjoinedits = UserPostMjoin::where('id',$mjoinId)->first();
        if(empty($mjoinedits))
            return redirect()->route('user_cms')->with('success', '找不到資料');
        return view('admin.user_mjoin_edit',compact('mjoinedits'));
    }
    //單獨顯示打工編輯
    public function user_cms_shop_edit($shopId)
    {
        $shopedits = UserPostWork::where('id',$shopId)->first();
        if(empty($shopedits))
            return redirect()->route('user_cms')->with('success', '找不到資料');
        return view('admin.user_shop_edit',compact('shopedits'));
    }
    //單獨顯示創作編輯
    public function user_cms_artwork_edit($artId)
    {
        $userarkworkedit = UserPostArkwork::where('id',$artId)->first();
        if(empty($userarkworkedit))
            return redirect()->route('user_cms')->with('success', '找不到資料');
        return view('admin.user_artwork_edit',compact('userarkworkedit'));
    }
    public function user_cms_mjoin_edit_submit($mjoinId,Request $request)
    {
        if(Auth::check()) {
            $mjoinedits = UserPostMjoin::find($mjoinId);
            if (!$mjoinedits) {
                return redirect()->route('user_cms')->with('error','找不到相應的信息');
            }
        
            $dates = explode(' - ', $mjoinedits->time);
            $start_date = Carbon::parse($dates[0]);
            $end_date = Carbon::parse($dates[1]);
            $current_time = Carbon::now();
        
            if ($current_time > $end_date) {
                return redirect()->route('user_cms')->with('success','時間已過，無法修改');
            }
        
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
        
            // 空值檢查
            if (empty($title) || empty($destination) || empty($time) || empty($diffDay) || empty($people) || empty($money) || empty($sex) || empty($skill) || empty($age) || empty($description)) {
                return redirect()->back()->with('error', '請填寫所有必填欄位')->withInput();
            }
        
            $mjoinedits->title = $title;
            $mjoinedits->destination = $destination;
            $mjoinedits->time = $time;
            $mjoinedits->diffDay = $diffDay;
            $mjoinedits->people = $people;
            $mjoinedits->money = $money;
            $mjoinedits->sex = $sex;
            $mjoinedits->skill = $skill;
            $mjoinedits->age = $age;
            $mjoinedits->description = $description;
            $mjoinedits->save();
        
            return redirect()->route('user_cms')->with('success','修改成功');
        } else {
            return redirect()->route('login')->with('error','請先登入');
        }
        
    }

    public function user_cms_shop_edit_submit(Request $request,$shopId)
    {
        if(Auth::check()) {
            $post = UserPostWork::find($shopId);
        
            // 檢查必填欄位是否為空
            $requiredFields = ['shop_name', 'selectwhere', 'location', 'driver_license_requirements', 'recruitment_period', 'sex', 'conditions_exp', 'work_hours', 'job_description', 'benefits', 'shop_information'];
            foreach($requiredFields as $field) {
                if(empty($request->input($field))) {
                    // 如果必填欄位為空，則返回編輯表單
                    return redirect()->back()->with('error', '請填寫所有必填欄位')->withInput();
                }
            }
        
            // 檢查其他欄位是否為空，如果為空，則將其設置為空字串
            $optionalFields = ['business_registration_number'];
            foreach($optionalFields as $field) {
                if(empty($request->input($field))) {
                    $request[$field] = ''; // 設置為空字串
                }
            }
        
            // 更新資料
            $post->fill($request->all());
            $post->language = implode(',', $request->input('language'));
            $post->job_description = implode(',', $request->input('job_description'));
            $post->benefits = implode(',', $request->input('benefits'));
            $post->save();
        
            return redirect()->route('user_cms')->with('success', '修改成功');
        } else {
            return redirect()->route('user_cms')->with('error', '???');
        }
        
    }
    //創作編輯送出
    public function user_cms_artwork_edit_submit(Request $request,$artId)
    {
        if(Auth::check())
        {
            if($request->has('editor')) {
                if(Auth::check()){
                    $user = Auth::user();
                    $post = UserPostArkwork::where('id', $artId)->first();
                    if(empty($post)){
                        return redirect()->route('user_cms')->with('error', '找不到相應的資料');
                    }
                    $post = UserPostArkwork::find($artId);
                    //dd($request);
                    if ($request->hasFile('image')) {
                        $imageData = file_get_contents($request->file('image')->getPathName());
                        $imageType = $request->file('image')->getClientMimeType();
                        $post->image_data = $imageData;
                        $post->image_type = $imageType;
                    } 
                    //時間tw
                    date_default_timezone_set('Asia/Taipei');
                    $title = $request->input('title');
                    $class = $request->input('class');
                    $main = $request->input('editor');
                           
                    $post->title = $title;
                    $post->class = $class;
                    $post->main  = $main;
                    $post->status = "pending";
                    $post->update();
                    return redirect()->route('user_cms')->with('success', '修改成功');
                }
            } else {
                return redirect()->back()->with('error', '內容需要有東西喔')->withInput();
            }
        } else {
            return redirect()->route('user_cms')->with('success', '???');
        } 
    }

    //CMS揪團刪除
    public function user_mjoin_delete($mjoinId,Request $request)
    {
        $mjoin = UserPostMjoin::where('id',$mjoinId)->first();
        $user = User::where('username',$mjoin->posted_by_u)->first();
        $mjoin->status = 'del';
        $mjoin->update();
        $notify = new Notify();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $user->id;
        if($request->input('msg')){
            $notify->main = $request->input('msg');
            $notify->status = 'pending';
            $notify->come_from = '創作';
            $notify->action = '刪除';
            $notify->article_id = $mjoinId;
            
            $notify->save();
            return redirect()->route('user_cms')->with('success','刪除成功');
        }
        $notify->main = '您的揪團貼文已經被刪除';
        $notify->status = 'pending';
        $notify->come_from = '創作';
        $notify->action = '刪除';
        $notify->article_id = $mjoinId;;
        $notify->save();
        return redirect()->route('user_cms')->with('success','刪除成功');
    }
    //CMS揪團貼文回復
    public function user_mjoin_delete_back($mjoinId)
    {
 
        $mjoin = UserPostMjoin::where('id',$mjoinId)->first();
        $dates = explode(' - ', $mjoin->time);
        $notify = new Notify();
        // 将开始日期和结束日期转换为 Carbon 实例
        $start_date = Carbon::parse($dates[0]);
        $end_date = Carbon::parse($dates[1]);
        $current_time = Carbon::now();
        if($current_time>$end_date){
            $mjoin->status = 'end';
            $notify->come_from = '創作';
            $notify->action = '回復刪除';
            $notify->article_id = $mjoinId;
            $notify->save();
            $mjoin->update();
            return redirect()->route('user_cms')->with('success','修改成功');
        }
        $mjoin->status = 'pending';
        $notify->come_from = '創作';
        $notify->action = '回復刪除';
        $notify->article_id = $mjoinId;
        $mjoin->update();
        return redirect()->route('user_cms')->with('success','修改成功');
    }

    //CMS打工刪除
    public function user_shop_delete($shopId,Request $request)
    {
        $shop = UserPostWork::where('id',$shopId)->first();
        $user = User::where('username',$shop->posted_by_u)->first();
        $shop->status = 'del';
        $shop->update();
        $notify = new Notify();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $user->id;
        if($request->input('msg')){
            $notify->main = $request->input('msg');
            $notify->status = 'pending';
            $notify->come_from = '打工';
            $notify->action = '刪除';
            $notify->article_id = $shopId;
            $notify->save();
            return redirect()->route('user_cms')->with('success','刪除成功');
        }
        $notify->main = '您的打工貼文已經被刪除';
        $notify->status = 'pending';
        $notify->come_from = '打工';
        $notify->action = '刪除';
        $notify->article_id = $shopId;
        $notify->save();
        return redirect()->route('user_cms')->with('success','刪除成功');
    }
    //CMS打工貼文回復
    public function user_shop_delete_back($shopId)
    {
 
        $shop = UserPostWork::where('id',$shopId)->first();
        $user = User::where('username',$shop->posted_by_u)->first();
        $dates = explode(' - ', $shop->recruitment_period);

        // 将开始日期和结束日期转换为 Carbon 实例
        $start_date = Carbon::parse($dates[0]);
        $end_date = Carbon::parse($dates[1]);
        $current_time = Carbon::now();
        $notify = new Notify();
        if($current_time>$end_date){
            $notify->come_from = '打工';
            $notify->action = '刪除回復';
            $notify->article_id = $shopId;
            $shop->status = 'end';
            $notify->save();
            $shop->update();
            return redirect()->route('user_cms')->with('success','修改成功');
        }
        $shop->status = 'pending';
        $shop->update();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $user->id;
        $notify->main = '您的打工貼文已經被刪除';
        $notify->status = 'pending';
        $notify->come_from = '打工';
        $notify->action = '刪除回復';
        $notify->article_id = $shopId;
        $notify->save();
        return redirect()->route('user_cms')->with('success','修改成功');
    }

    //創作刪除
    public function user_artwork_delete($arkId,Request $request)
    {
        $ark = UserPostArkwork::where('id',$arkId)->first();
        //$user = User::where('username',$shop->posted_by_u)->first();
        $ark->status = 'del';
        $ark->update();
        $notify = new Notify();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $ark->user_id;
        if($request->input('msg')){
            $notify->main = $request->input('msg');
            $notify->status = 'pending';
            $notify->come_from = '創作';
            $notify->action = '刪除';
            $notify->article_id = $arkId;
            $notify->save();
            return redirect()->back()->with('success', '刪除成功');
        }
        $notify->main = '您的創作貼文已經被刪除';
        $notify->status = 'pending';
        $notify->come_from = '創作';
        $notify->action = '刪除';
        $notify->article_id = $arkId;
        $notify->save();
        return redirect()->back()->with('success', '刪除成功');
    }
    //CMS打工貼文回復
    public function user_artwork_delete_back($artId)
    {
 
        $shop = UserPostArkwork::where('id',$artId)->first();
        //$user = User::where('username',$shop->posted_by_u)->first();
        //$dates = explode(' - ', $shop->recruitment_period);

        // 将开始日期和结束日期转换为 Carbon 实例
        //$start_date = Carbon::parse($dates[0]);
        //$end_date = Carbon::parse($dates[1]);
        //$current_time = Carbon::now();
        
        
        
        $shop->status = 'pending';
        $shop->update();
        $notify = new Notify();
        $notify->user_id = Auth::user()->id;
        $notify->receiver_id = $shop->user_id;
        $notify->main = '您的打工貼文已經被刪除';
        $notify->status = 'pending';
        $notify->come_from = '創作';
        $notify->action = '刪除回復';
        $notify->article_id = $artId;
        $notify->save();
        return redirect()->route('user_cms')->with('success','修改成功');
    }
    
}