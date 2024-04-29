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

use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class UserController extends Controller
{
    //登入
    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        //dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $state = $user->state;

            if ($state == 'suspension') {
                Auth::logout(); // 登出用户
                return redirect()->route('login')->with('error','帳號已被停權，請聯絡管理者');
            } else {
                session(['user_email' => $credentials['email']]);
                session(['user_name' => $user->username]);
                $user_id = Auth::user();
                $user_record = UserRecord::where('user_id',$user_id->id)->first();
                if(!$user_record){
                    $user_record = new UserRecord;
                    $user_record->user_id = $user_id->id;
                    $user_record->ip = $request->ip();
                    $current_time = date('Y-m-d H:i:s');
                    $user_record->userstatus = 1;
                    $user_record->logintime = $current_time;
                    $user_record->save();
                    return redirect()->route('front');
                }
                $user_record->ip = $request->ip();
                $current_time = date('Y-m-d H:i:s');
                $user_record->logintime = $current_time;
                $user_record->loginmany += 1;
                $user_record->userstatus = 1;
                $user_record->update();
                return redirect()->route('front');
            }
        } else {
            return redirect()->route('login')->with('error','登入失敗，請檢查您的帳號和密碼');
        }
    }
    //登出
    public function logout(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user();
            
            $user_record = UserRecord::where('user_id',$user_id->id)->first();
            if(!$user_record){
                $user_record = new UserRecord;
                $user_record->user_id = $user_id->id;
                $user_record->ip = $request->ip();
                $current_time = date('Y-m-d H:i:s');
                $user_record->logintime = $current_time;
                $user_record->userstatus = 1;
                $user_record->save();
            }
            $user_record = UserRecord::where('user_id',$user_id->id)->first();
            $user_record->userstatus = 0;
            $user_record->update();
            Auth::logout();

            $request->session()->invalidate();

            return redirect()->route('front');
        }
    }
    //註冊
    public function user_register(Request $request)
    {
        if ($request->password != $request->confirm_password) {
            session()->flash('error', '密碼和再次密碼不一致');
            return redirect()->route('register');
        }
        if (User::where('username', $request->username)->exists()) {
            return redirect()->route('register')->with('error','註冊失敗，您的用戶名重複');
        }
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('register')->with('error','註冊失敗，您的電子郵件已經註冊過');
        }

        // 保存新用戶
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->permissions = '3';
        $user->sex = '未填寫';
        $user->state = 'action';
        $user->verify = 'no';

        // 創建用戶記錄
       // 創建用戶記錄
        $user_record = new UserRecord();
        if ($user_record) { // 確認 $user_record 是一個有效的物件
            $user_record->ip = $request->ip();
            $user_record->loginmany = 1; // 初始化登錄次數為 1
            $user_record->userstatus = 1; // 初始化用戶狀態
        } else {
            // 如果 $user_record 創建失敗，你可以處理這個情況，例如返回註冊頁面並顯示錯誤訊息
            session()->flash('error', '無法創建用戶記錄');
            return redirect()->route('register');
        }

        // 檢查兩個模型是否保存成功，如果成功，才繼續
        DB::beginTransaction();
        try {

            $user->save();
            // 在 $user->save() 後面立即設置 $user_record->user_id

            $user_record->user_id = $user->id;
  
            $user_record->save();
            DB::commit();
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                session(['user_email' => $credentials['email']]);
                session(['user_name' => $user->username]);
                $user_id = Auth::user();
                $user_record = UserRecord::where('user_id', $user_id->id)->first();
                $user_record->ip = $request->ip();
                $current_time = date('Y-m-d H:i:s');
                $user_record->logintime = $current_time;
                $user_record->loginmany += 1;
                $user_record->userstatus = 1;
                $user_record->update();
                return redirect()->route('verify_phone');
            }
        } catch (\Exception $e) {
            DB::rollback();
            // 如果出現錯誤，可以記錄日誌或者返回註冊頁面並顯示錯誤信息
            session()->flash('error', '註冊失敗，請稍後再試');
            return redirect()->route('register');
        }

        
    }
    //電話插入and檢查
    public function user_phone($phone)
    {
        if(Auth::check()){
            //尋找手機資料庫有無資料
            $user_phone_check = User_phone::where('phone',$phone)->first();
            //無建立
            if(!$user_phone_check){
                $user = Auth::user();
                $user_phone = User::where('id',$user->id)
                                  ->where('verify','yes')
                                  ->first();
                if(!$user_phone){
                    $user_phone_create = new User_phone();
                    $user_phone_create->user_id = $user->id;
                    $user_phone_create->phone = $phone;
                    $user_phone_create->save();
                    return response()->json(['status' => 'OK']);
                } else {
                    return response()->json(['status' => 'False','mes' => '這支電話已經驗證過了，請換另一個電話驗證。']);
                }
            } else {
                $user = Auth::user();
                $user_phone = User::where('id',$user->id)
                                  ->where('verify','yes')
                                  ->first();
                if(!$user_phone){
                    return response()->json(['status' => 'OK']);
                } else {
                    return response()->json(['status' => 'False']);
                }
                
            }
        } else {
            return redirect()->route('error');
        }
        
    }
    //資料庫電話驗證轉變 
    public function user_phone_verify($phone)
    {
        if(Auth::check()){
            if(Auth::user()->verify == 'no'){
                $user_double_check = User_phone::where('phone',$phone)->first();
                if($user_double_check){
                    $user = Auth::user();
                    $user_ver = User::where('id',$user->id)->first();
                    $user_ver->verify = 'yes';
                    $user_ver->update();
                    return response()->json(['status' => 'OK']);
                } else {
                    return response()->json(['status' => 'False','mes' => '這支電話已經驗證過了，請換另一個電話驗證。']);
                }
            } else {
                return redirect()->route('error');
            }
            
        } else {
            return redirect()->route('login')->with('error','請先登入好嗎');
        }
    }
    //驗證電話表單
    public function showform()
    {
        if(Auth::check()){
            if(Auth::user()->verify == 'no'){
                return view('auth.verify_phone');
            } else {
                return redirect()->route('front');
                alert("請勿重複驗證，如有問題請聯絡管理員");
            }
            
        } else {
            return redirect()->route('login')->with('error','請先登入謝謝');
        }
    }

    //用戶資料
    public function user_data($username)
    {
        
            $user = User::where('username', $username)->first();
            $userid = $user->id;
            //資料                                
            $userrecord = DB::table('record')
                            ->select('record.*', 'user.*', DB::raw('FLOOR(DATEDIFF(CURDATE(), user.age) / 365) AS age'))
                            ->leftJoin('user', 'record.user_id', '=', 'user.id')
                            ->where('user.username', $username)
                            ->first();

            //創作                
            $userarkworks = DB::table('artwork')
                              ->select('artwork.*','user.id as user-id')
                              ->leftJoin('user','artwork.user_id','=','user.id')
                              ->where('user.username',$username)
                              ->where('artwork.status','<>','del')
                              ->orderBy('id','desc')
                              ->get();

            $userinfo = DB::table('user_profile')
                              ->select('user_profile.*','user.id as user-id')
                              ->leftJoin('user','user_profile.user_id','=','user.id')
                              ->where('user.username',$username)
                              ->first();


            $userCollections = DB::table('user_collections_artwork')
                            ->select('user_collections_artwork.*', 'artwork.*','user_collections_artwork.created_at as col_created_at')
                            ->leftJoin('artwork', 'user_collections_artwork.article_id', '=', 'artwork.id')
                            ->where('user_collections_artwork.user_id',$userid)
                            ->where('user_collections_artwork.status', '<>', 0)
                            ->where('artwork.status', '<>', 'del')
                            ->get();
            
            $userCollections_shop = DB::table('user_collections_shop')
                            ->select('user_collections_shop.*', 'shop.*')
                            ->leftJoin('shop', 'user_collections_shop.article_id', '=', 'shop.id')
                            ->where('user_collections_shop.user_id',$userid)
                            ->where('user_collections_shop.status', '<>', 0)
                            ->where('shop.status', '<>', 'del')
                            ->get();

            $userCollections_mjoin = DB::table('user_collections_mjoin')
                            ->select('user_collections_mjoin.*', 'mjoin.*')
                            ->leftJoin('mjoin', 'user_collections_mjoin.article_id', '=', 'mjoin.id')
                            ->where('user_collections_mjoin.user_id',$userid)
                            ->where('user_collections_mjoin.status', '<>', 0)
                            ->where('mjoin.status', '<>', 'del')
                            ->get();
                                    
                          
                              
            if($userrecord == null){
                return redirect()->route('error');
            }

            return view('auth.userprofile', compact('userrecord' ,'userarkworks','userinfo','userCollections','userCollections_mjoin','userCollections_shop'));
        
    }    
    //全部創作
    public function user_artwork_all($username)
    {
        $userarkworksall = DB::table('artwork')
                             ->select('artwork.*','user.id as user-id')
                             ->leftjoin('user','artwork.user_id','=','user.id')
                             ->orderBy('artwork.id','desc')
                             ->where('user.username',$username)
                             ->where('artwork.status','<>','del')
                             ->get();
        /*$userarkworksall = UserPostArkwork::orderby('id','desc')
                                          ->where('user_id',)
                                          ->where('status','<>','del')
                                          ->get();*/
        

        return view('auth.userprofileark' ,compact('userarkworksall','username'));
    }

    //單獨創作顯示
    public function arkwork_solo($ark_id)
    {
        $userarkworksolo = UserPostArkwork::select('user.username', 'artwork.*')
                                            ->leftJoin('user', 'artwork.user_id', '=', 'user.id')
                                            ->where('artwork.id', $ark_id)
                                            ->where('artwork.status', '<>', 'del')
                                            ->first();
        if($userarkworksolo == null){
            return redirect()->route('error');
        }
                                
        $userartworkreplys = Artwork_reply::where('reply_id' ,$ark_id)->get();
        //全部按讚人數
        
        return view('auth.arkworksolo' ,compact('userarkworksolo','userartworkreplys'));
    }
    //編輯貼文表單邏輯設計
    public function arkwork_edit($ark_id)
    {
        $userarkworkedit = UserPostArkwork::where('id',$ark_id)
                                          ->where('status','<>','del')
                                          ->first();
        
        if($userarkworkedit)
        {
            return view('auth.arkworkedit' ,compact('userarkworkedit'));
        }
        else
        {
            return redirect()->route('error');
        }
    }
    //編輯貼文送出
    public function arkwork_edit_post(Request $request,$ark_id)
    {
        $user = Auth::user();
        $check_ORM = UserPostArkwork::select('user_id')
                                    ->where('id',$ark_id)
                                    ->first();
        //dd($check_ORM,$posted_by_u);
        if(Auth::check())
        {
            if($user->id === $check_ORM->user_id)
            {
                if($request->has('editor')) {
                    $post = UserPostArkwork::find($ark_id);
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
                    //dd($post);
                    return redirect()->route('user_profile_d',['username'=> $user->username]);
                }
            }
            else
            {
                return redirect()->route('error');
            }
            
        }
        else
        {
            return redirect()->route('/');
        }
    }

    //創作回覆
    public function artwork_reply_sumbit(Request $request,$ark_id)
    {
        if($request->has('MessageTextarea_' . $ark_id)) {
            date_default_timezone_set('Asia/Taipei');
            $main = $request->input('MessageTextarea_' . $ark_id);
            $count = Artwork_reply::where('reply_id', $ark_id)->count();
            $reply = new Artwork_reply();
            
            $reply->reply_id = $ark_id;
            $reply->name_e = session('user_email');
            $reply->name_u = session('user_name');
            $reply->main = $main;
            $reply->status = "pending";
            $level = ($count==0) ? 1 : ($count+1) ;
            $reply->level = $level;
            $reply->save();

            return redirect()->route('arkwork_solo',['ark_id'=> $ark_id]);
        }else{
            return redirect()->back()->with('error', '回复内容不能为空！');
        }
    }

    //創作回覆顯示
    public function artwork_reply($ark_id)
    {
        date_default_timezone_set('Asia/Taipei');
        $artwork_replys = Artwork_reply::where('reply_id', $ark_id)->get();
        if($artwork_replys){
            return redirect()->route('arkwork_solo', ['ark_id' => $ark_id])->with(compact('artwork_replys'));
        }      
    }

    //創作刪除
    public function artwork_del($ark_id)
    {
        date_default_timezone_set('Asia/Taipei');
        $artwork_del = UserPostArkwork::where('id',$ark_id)->first();
        if(Auth::check()){
            $user = Auth::user();
            $artwork_del->status = "del";
            $artwork_del->update();
            return redirect()->route('user_profile_d',['username'=> $user->username]);
        }else {
            return redirect()->route('login')->with('error','請先登入好嗎');
        }
    }
    //創作刪除 只是這是回到全部而已
    public function artwork_del_a($ark_id)
    {
        date_default_timezone_set('Asia/Taipei');
        $artwork_del = UserPostArkwork::where('id',$ark_id)->first();
        if(Auth::check()){
            $user = Auth::user();
            $artwork_del->status = "del";
            $artwork_del->update();
            return redirect()->route('arkwork_all',['username'=> $user->username]);
        }else {
            return redirect()->route('login')->with('error','請先登入好嗎');
        }
    }
}
