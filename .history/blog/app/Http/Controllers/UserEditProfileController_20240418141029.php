<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\User_phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\User_profile_public;

class UserEditProfileController extends Controller
{
    public function editProfile()
    {
        if(Auth::check()){
            $user_data = Auth::user();
            //$userdataedit = User::where('id', $user_data->id)->first();
            $user_check_null = User_profile_public::where('user_id', $user_data->id)->first();
            if(!$user_check_null){
                $user_cr_null = new User_profile_public();
                $user_cr_null->user_id = $user_data->id;
                $user_cr_null->user_age_public = '1';
                $user_cr_null->user_sex_public = '1';
                $user_cr_null->save();
            }
            $userdataedit = DB::table('user')
                            ->select('user.*','user_phone.phone')
                            ->leftJoin('user_phone','user.id','=','user_phone.user_id')
                            ->where('user.id',$user_data->id)
                            ->first();
            $user_public = User_profile_public::where('user_id', $user_data->id)->first();  
            return view('auth.edituserproile', compact('userdataedit','user_public'));
        } else {
            return redirect()->route('login')->with('error','請先登入');
        }
    }

}