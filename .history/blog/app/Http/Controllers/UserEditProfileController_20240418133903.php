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

class UserEditProfileController extends Controller
{
    public function editProfile()
    {
        if(Auth::check()){
            $user_data = Auth::user();
            //$userdataedit = User::where('id', $user_data->id)->first();
            $userdataedit = DB::table('user')
                            ->select('user.*','user_phone.phone')
                            ->leftJoin('user_phone','user.id','=','user_phone.user_id')
                            ->where('user.id',$user_data->id)
                            ->first();
            return view('auth.edituserproile', compact('userdataedit'));
        } else {
            return redirect()->route('login')->with('error','請先登入');
        }
    }

}