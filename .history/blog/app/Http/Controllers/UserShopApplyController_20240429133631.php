<?php

namespace App\Services;
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\UserPostMjoin;
use App\Models\Mjoin_reply;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Auth\SendActionLink;
use Kreait\Firebase\Auth\SendActionLink\RawOobCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\UserPostArkwork;
use App\Models\Artwork_reply;
use Illuminate\Http\Request;
use App\Models\UserGood;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Models\User_phone;
use App\Models\User_join_mjoin;
use App\Models\User_notify_mjoin;
use App\Models\Shop_join;
use App\Models\UserPostWork;
use App\Models\Shop_apply;


use function Symfony\Component\HttpKernel\Log\record;

class UserShopApplyController extends Controller
{
    public function shop_apply_form()
    {

        $com = Shop_apply::where('user_id',Auth::user()->id)->where('status','pending')->get();
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        if(Auth::user()->verify != 'yes'){
            return view('auth.verify_phone')->with('error', '請先驗證過手機');
        }
        if(Auth::user()->permissions != 3 &&  1){
            return redirect('/work')->with('error', '您已經是店家了');
        }
        if($com){
            return redirect('/work')->with('error', '您的店家申請正在審核中，請稍後');
        }
        return view('auth.usershop_applyform');
    }

    public function shop_score_form_submit(Request $request)
    {
        //dd($request);
        $apply = Shop_apply::where('user_id',Auth::user()->id)->first();
        if(!Auth::check()){
            return redirect('/login')->with('error', '請先登入');
        }
        if(Auth::user()->verify != 'yes'){
            return view('auth.verify_phone')->with('error', '請先驗證過手機');
        }
        if(Auth::user()->permissions != 3 &&  1){
            return redirect('/work')->with('error', '您已經是店家了');
        }
        if($apply){
            return redirect('/work')->with('error', '您已經是店家了，請勿重複申請');
        }
        $shop_apply = new Shop_apply();
        $shop_apply->user_id = Auth::user()->id;
        $shop_apply->company_name = $request->input('company_name');
        $shop_apply->phone_number = $request->input('phone_number');
        $shop_apply->uniform_numbers = $request->input('uniform_numbers');
        $shop_apply->county = $request->input('county');
        $shop_apply->company_location = $request->input('company_location');
        $shop_apply->applicant = $request->input('applicant');
        if ($request->hasFile('image') ) {
            $imageData = file_get_contents($request->file('image')->getPathName());
            $imageType = $request->file('image')->getClientMimeType();
            $imageData1 = file_get_contents($request->file('image1')->getPathName());
            $imageType1 = $request->file('image1')->getClientMimeType();
        } else {
            $imageData = null;
            $imageType = null;
            $imageData1 = null;
            $imageType1 = null;
        }
        $shop_apply->image_data = $imageData;
        $shop_apply->image_type = $imageType;

        $shop_apply->image_data1 = $imageData1;
        $shop_apply->image_type1 = $imageType1;

        $shop_apply->status = 'pending';

        $shop_apply->save();

        return redirect('/work')->with('success', '申請成功，請等待審核');
        
    }
}