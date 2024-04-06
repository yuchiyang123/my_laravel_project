<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserPostWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class UserWorkController extends Controller
{
    public function work_post(Request $request){
        if(Auth::check()){
            if($request->has('editor')) {
                $post = new UserPostWork();
                //時間tw
                date_default_timezone_set('Asia/Taipei');
                $title = $request->input('title');
                $destination = $request->input('destination');
                $time = $request->input('time');
                $diffDay = $request->input('diffDay');
                $people = $request->input('people');
                $money = $request->input('money');
                $sex = $request->input('sex');
                $skill = $request->input('skill');
                $age = $request->input('age');
                $description = $request->input('editor');
                
                $post->title = $title;
                $post->destination = $destination;
                $post->time = $time;
                $post->diffDay = $diffDay;
                $post->people = $people;
                $post->money = $money;
                $post->sex = $sex;
                $post->skill = $skill;
                $post->age = $age;
                $post->description = $description;
                $post->posted_by = session('user_email');
                $post->status = "pending";
                $post->save();
                return redirect()->route('front');
            }
        } else {
            return redirect()->route('login');
        } 
        
    }
}