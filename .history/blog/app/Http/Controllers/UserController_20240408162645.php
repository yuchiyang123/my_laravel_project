<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\UserPostArkwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
                return redirect()->route('front');
            }
        } else {
            return redirect()->route('login')->with('error','登入失敗，請檢查您的帳號和密碼');
        }
    }

    public function user_data($username)
    {
        if (Auth::check()) {
            //$username = Auth::user()->username; 
            $userprofile = User::where('username', $username)->first(); 
            $userrecord = UserRecord::where('username', $username)->first();
            $userarkworks = UserPostArkwork::orderby('id','desc')
                                            ->where('posted_by_u',$username)->get();
            return view('auth.userprofile', compact('userprofile', 'userrecord' ,'userarkworks','username'));
        }
    }    

    //全部創作
    public function user_artwork_all($username)
    {
        $userarkworksall = UserPostArkwork::orderby('id','desc')
                                          ->where('posted_by_u',$username)
                                          ->where('status','<>','del')
                                          ->get();

        return view('auth.userprofileark' ,compact('userarkworksall','username'));
    }

    //單獨創作顯示
    public function arkwork_solo($ark_id)
    {
        $userarkworksolo = UserPostArkwork::where('id',$ark_id)
                                          ->where('status','<>','del')
                                          ->first();

        return view('auth.arkworksolo' ,compact('userarkworksolo'));
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
            return redirect()->route('front');
        }
    }
    //編輯貼文送出
    public function arkwork_edit_post(Request $request,$ark_id)
    {
        $posted_by_u = session('user_name');
        $posted_by_e = session('user_email');
        $check_ORM = UserPostArkwork::select('posted_by_u')
                                    ->where('id',$ark_id)
                                    ->first();
        //dd($check_ORM,$posted_by_u);
        if(Auth::check())
        {
            if($posted_by_u === $check_ORM->posted_by_u)
            {
                if($request->has('editor')) {
                    $post = UserPostArkwork::find($ark_id);
                    $posted_by_u = session('user_name');
                    $posted_by_e = session('user_email');
                    //dd($request);
                    if ($request->hasFile('image')) {
                        $imageData = file_get_contents($request->file('image')->getPathName());
                        $imageType = $request->file('image')->getClientMimeType();
                    } else {
                        $imageData = null;
                        $imageType = null;
                    }
                    //時間tw
                    date_default_timezone_set('Asia/Taipei');
                    $title = $request->input('title');
                    $class = $request->input('class');
                    $main = $request->input('editor');
                    
    
                    $post->image_data = $imageData;
                    $post->image_type = $imageType;
                    $post->title = $title;
                    $post->class = $class;
                    $post->main  = $main;
                    $post->status = "pending";
                    $post->update();
                    dd($post);
                    return redirect()->route('user_profile_d',['username'=> $posted_by_u]);
                }
            }
            else
            {
                return redirect()->route('front');
            }
            
        }
        else
        {
            return redirect()->route('/');
        }
    }
}
