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
use App\Models\UserProfile;

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
            if($request->input('image')!=null){
                $base64_image_data = $request->input('image');
                $base64_image_data = substr($base64_image_data, strpos($base64_image_data, ',') + 1);
                $mime_type = explode(';', explode(':', substr($request->input('image'), 0, strpos($request->input('image'), ',')))[1])[0];
                $image_binary = base64_decode($base64_image_data);
                $user->profileImage	= $image_binary;
                $user->profileImage_type = $mime_type;
            }
            
            $userProfile->user_age_public = $request->has('age_public') ? 1 : 0;
            $userProfile->user_sex_public = $request->has('sex_public') ? 1 : 0;
            if($request->input('time')!=null){
                $user->age = $request->input('time');
            }
            $user->sex = $request->input('sex');
            

            $user->update();
            $userProfile->update();

            return redirect()->route('editProfile')->with('success', '修改成功');
        } else {
            return redirect()->route('login')->with('error', '請先登入');
        }
    }

    public function edit_profile_youinfo_from()
    {
        if(Auth::check()){
            $user_data = Auth::user();
            //$userdataedit = User::where('id', $user_data->id)->first();
            $user_check_null = UserProfile::where('user_id', $user_data->id)->first();
            if(!$user_check_null){
                $user_cr_null = new User_profile_public();
                $user_cr_null->user_id = $user_data->id;
                $user_cr_null->favorite_articles_visibility = '0';
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