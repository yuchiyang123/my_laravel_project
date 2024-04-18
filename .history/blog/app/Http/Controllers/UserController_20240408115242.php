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
            $username = Auth::user()->username; 
            $userprofile = User::where('username', $username)->first(); 
            $userrecord = UserRecord::where('username', $username)->first();
            $userarkworks = UserPostArkwork::orderby('id','desc')
                                            ->where('posted_by_u',$username)->get();
            return view('auth.userprofile', compact('userprofile', 'userrecord' ,'userarkworks'));
        }
    }    
}
