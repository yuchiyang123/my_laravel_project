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
                $shop_name = $request->input('shop_name');
                $selectwhere = $request->input('selectwhere');
                $business_registration_number = $request->input('business_registration_number');
                $location = $request->input('location');
                $driver_license_requirements = $request->input('driver_license_requirements');
                $recruitment_period = $request->input('recruitment_period');
                $sex = $request->input('sex');
                $language = $request->input('language');
                $conditions_exp = $request->input('conditions_exp');
                $work_hours = $request->input('work_hours');
                $job_description = $request->input('job_description');
                $benefits = $request->input('benefits');
                $shop_information = $request->input('editor');
                $senderu = $request->input('senderu');
                $sendere = $request->input('sendere');

                $post->shop_name = $shop_name;
                $post->selectwhere = $selectwhere;
                $post->business_registration_number = $business_registration_number;
                $post->location = $location;
                $post->driver_license_requirements = $driver_license_requirements;
                $post->recruitment_period = $recruitment_period;
                $post->sex = $sex;
                $post->language = $language;
                $post->conditions_exp = $conditions_exp;
                $post->work_hours = $work_hours;
                $post->job_description = $job_description;
                $post->benefits = $benefits;
                $post->shop_information = $shop_information;
                $post->senderu = $senderu;
                $post->sendere = $sendere;
                $post->status = "pending";
                $post->save();
                return redirect()->route('login');
            }
        } else {
            return redirect()->route('login');
        } 
    }
}