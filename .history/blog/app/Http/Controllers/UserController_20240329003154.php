<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');
        $user = User::where('email', $name)->first();
        if($user){
            //user存在
            if(password_verify($password, $user->password)){
                $state = $user->state;
                //用戶停權
                if($state == 'suspension'){
                    return redirect()->route('login')->with('error','帳號已被停權，請聯絡管理者');
                }else{
                    //登入成功
                    return redirect()->route('home');
                }
            }else{
                //密碼錯誤
                return redirect()->route('login')->with('error','密碼錯誤');
            }
        }else{
            return redirect()->route('login')->with('error','用戶不存在');
        }
    }    
}
