<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
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
            $userdataedit = User::where('id', $user_data->id)->first();
            return view('auth.edituserproile', compact('userdataedit'));
        } else {
            return redirect()->route('login')->with('error','請先登入');
        }
    }

}