<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        $credentials['password'] = Hash::make($credentials['password']);
        //dd($credentials);
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
        /*$name = $request->input('name');
        $password = $request->input('password');
        $user = User::where('email', $name)->first();
        if($user){
            //user存在
            if( $password === $user->password){
                $state = $user->state;
                //用戶停權
                if($state == 'suspension'){
                    return redirect()->route('login')->with('error','帳號已被停權，請聯絡管理者');
                }else{
                    //登入成功
                    session(['user_email' => $name]);
                    session(['user_name' => $user->username]);
                    return redirect()->route('front');
                }
            }else{
                //密碼錯誤
                return redirect()->route('login')->with('error','密碼錯誤');
            }
        }else{
            return redirect()->route('login')->with('error','用戶不存在');
        }*/
    }    
}
