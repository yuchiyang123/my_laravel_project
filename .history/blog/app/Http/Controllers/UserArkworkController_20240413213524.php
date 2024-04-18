<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserPostArkwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class UserArkworkController extends Controller
{
    public function arkwork_post(Request $request){
        if(Auth::check())
        {
            if($request->has('editor')) {
                if(Auth::check()){
                    $user = Auth::user();
                    $post = new UserPostArkwork();
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
                    $post->user_id = $user->id;
                    $post->status = "pending";
                    $post->save();
                    return redirect()->route('user_profile_d',['username'=> $user->username]);
                }
            } else {
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        } 
    }
}