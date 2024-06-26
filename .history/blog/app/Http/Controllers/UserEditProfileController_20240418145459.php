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

    public function editProfilesubmit(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userProfile = User_profile_public::where('user_id', $user->id)->first();

            $userProfile->user_age_public = $request->has('age_public') ? 1 : 0;
            $userProfile->user_sex_public = $request->has('sex_public') ? 1 : 0;

            $user_del = User::where('id', $user->id)->first();
            $user_del->age = $request->input('time');
            $user_del->sex = $request->input('sex');

            $user_del->save();
            $userProfile->save();

            return redirect()->back()->with('success', '个人资料更新成功');
        } else {
            return redirect()->route('login')->with('error', '请先登录');
        }
    }


}