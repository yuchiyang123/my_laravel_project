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
        if(Auth::check()){
            if($request->has('editor')) {
                $posted_by_u = session('user_name');
                $posted_by_e = session('user_email');
                $post = new UserPostArkwork();
                dd($request);
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
                $post->posted_by_u = $posted_by_u;
                $post->posted_by_e = $posted_by_e;
                $post->status = "pending";
                $post->save();
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        } 
    }
}