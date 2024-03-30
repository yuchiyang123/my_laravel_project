<?php

namespace App\Http\Controllers;

use App\Models\User;

class userlogin extends Controller
{
    public function login($name, $password)
    {
        $user = User::where('email', $name)->first();
        if($user){
            //user存在
            $state = $user->state;
            //用戶停權
            if($state == 'suspension'){

            }else{

            }
        }else{
            
        }
    }    
}
