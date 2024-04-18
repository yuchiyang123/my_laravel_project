<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserArkwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class UserArkworkController extends Controller
{
    public function arkwork_post(Request $request){
        if(Auth::check()){
            if($request->has('editor')) {
                $senderu = session('user_name');
                $sendere = session('user_email');
                $post = new UserArkwork();
                
                if ($request->hasFile('image')) {
                    $imageData = file_get_contents($request->file('image')->getPathName());
                    $imageType = $request->file('image')->getClientMimeType();
                } else {
                    $imageData = null;
                    $imageType = null;
                }
                


                //時間tw
                date_default_timezone_set('Asia/Taipei');
                $shop_name = $request->input('shop_name');
                $selectwhere = $request->input('selectwhere');
                $business_registration_number = $request->input('business_registration_number');
                $location = $request->input('location');
                $driver_license_requirements = $request->input('driver_license_requirements');
                $recruitment_period = $request->input('recruitment_period');
                $sex = $request->input('sex');
                $languages = $request->input('languages');
                $conditions_exp = $request->input('conditions_exp');
                $work_hours = $request->input('work_hours');
                $job_description = $request->input('job_description');
                $benefits = $request->input('benefits');
                $shop_information = $request->input('editor');
                
                //陣列轉字串
                 // 從表單中獲取多選框的值
                $languageString = implode(',', $languages); // 將陣列中的值用逗號分隔合併成字串
                $job_descriptionString = implode(',', $job_description);
                $benefitsString = implode(',', $benefits);

                $post->shop_name = $shop_name;
                $post->selectwhere = $selectwhere;
                $post->business_registration_number = $business_registration_number;
                $post->location = $location;
                $post->driver_license_requirements = $driver_license_requirements;
                $post->recruitment_period = $recruitment_period;
                $post->sex = $sex;
                $post->language = $languageString;
                $post->conditions_exp = $conditions_exp;
                $post->work_hours = $work_hours;
                $post->job_description = $job_descriptionString;
                $post->benefits = $benefitsString;
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