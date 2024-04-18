<?php


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
        $user_record = new UserRecord();
        $user_record->ip = $request->ip();
        $user_record->loginmany = 1; // 初始化登錄次數為 1
        $user_record->userstatus = 0; // 初始化用戶狀態

        // 檢查兩個模型是否保存成功，如果成功，才繼續
        DB::beginTransaction();
        try {
            $user->save();
            $user_record->user_id = $user->id; // 使用新用戶的 ID
            $user_record->save();
            DB::commit();

            // 設置用戶 session 並重定向到前端頁面
            session(['user_email' => $request->email]);
            session(['user_name' => $request->username]);
            return redirect()->route('front');
        } catch (\Exception $e) {
            DB::rollback();
            // 如果出現錯誤，可以記錄日誌或者返回註冊頁面並顯示錯誤信息
            session()->flash('error', '註冊失敗，請稍後再試');
            return redirect()->route('register');
        }
    }
    
    //傳送驗證訊息
    

    protected $firebaseAuth;

    public function __construct(Auth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }


    public function sendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['phone' => 'Invalid phone number']);
        }

        // 生成隨機驗證碼
        $code = mt_rand(1000, 9999);

        // 發送驗證碼
        $phoneNumber = $request->phone;
        $this->firebaseAuth->sendSignInLinkToEmail($phoneNumber, $code);

        // 將驗證碼存入 session 中
        $request->session()->put('verification_code', $code);
        return redirect()->route('phone_verification.verify');
    }

    public function verify(Request $request)
    {
        $verificationCode = $request->session()->get('verification_code');

        return view('phone_verification_verify', compact('verificationCode'));
    }

    public function verify_phone(Request $request)
    {
        $inputCode = $request->input('verification_code');
        $verificationCode = $request->session()->get('verification_code');

        if ($inputCode == $verificationCode) {
            // 驗證碼正確，執行相應的動作
            return redirect()->route('front')->with('success', 'Phone number verified successfully.');
        } else {
            return back()->withErrors(['verification_code' => 'Invalid verification code.'])->withInput();
        }
    }


    public function user_data($username)
    {
        
            //$username = Auth::user()->username; 
            /*$userprofile = User::where('username', $username)->first(); 
            $userrecord = UserRecord::where('username', $username)->first();
            $userarkworks = UserPostArkwork::orderby('id','desc')
                                            ->where('posted_by_u',$username)
                                            ->where('status','<>','del')
                                            ->get();*/
            //資料                                
            $userrecord = DB::table('record')
                        ->select('record.*', 'user.*', DB::raw('DATEDIFF(CURDATE(), user.age) / 365 AS age'))
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
            if($userrecord == null){
                return redirect()->route('error');
            }

            return view('auth.userprofile', compact('userrecord' ,'userarkworks'));
        
    }    
    //全部創作
    public function user_artwork_all($username)
    {
        $userarkworksall = DB::table('artwork')
                             ->select('artwork.*','user.username')
                             ->leftjoin('user','artwork.user_id','=','user.id')
                             ->orderBy('artwork.id','desc')
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
