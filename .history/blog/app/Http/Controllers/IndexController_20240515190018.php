<?php

namespace App\Services;
namespace App\Http\Controllers;

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
use App\Models\UserWorkController;
use App\Models\Artwork_reply;
use Illuminate\Http\Request;
use App\Models\UserGood;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Models\User_phone;
use App\Models\UserPostMjoin;
use App\Models\UserPostWork;


use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class IndexController extends Controller
{
    public function index(){
        try{
            
            $a = UserPostArkwork::where('status','<>','del')->get();
            $m = UserPostMjoin::where('status','<>','del')->get();
            $s = UserPostWork::where('status','<>','del')->get();

            return view('auth.index',compact('a','m','s'));
        }catch(\Exception $e){
        
            return view('auth.error');
        }
    }

    public function search(Request $request)
    {
        try{
            $search = $request->location;
            $search_all = UserPostMjoin::where('destination',$search)->get();
            //dd($search_all);
            $search_all_all = $search_all->merge(UserPostWork::where('selectwhere',$search)->get());
            if($search_all_all)
                return view('auth.all_search',compact('search_all_all','search'));
            else
                return view('auth.all_search')->with('found','沒有結果');
        } catch(\Exception $e){
            return view('auth.error');
        }
    }

    public function mjoin_search(Request $request)
    {
        try{
            $search = $request->location;
            $search_all_all = UserPostMjoin::where('destination',$search)->get();
            
            return view('auth.all_search',compact('search_all_all','search'));
            
        } catch(\Exception $e){
            return view('auth.error');
        }
    }

    public function shop_search(Request $request)
    {
        //dd($request->filled('destination'));
        try{
            $query = UserPostWork::query();

        // 處理地區條件
        if ($request->filled('destination')) {
            $query->where('selectwhere', $request->input('destination'));
        } else {
            $query->where('selectwhere', 'LIKE', '%');
        }

        // 處理性別條件
        if ($request->filled('sex')) {
            $query->where('sex', $request->input('sex'));
        } else {
            $query->where('sex', 'LIKE', '%');
        }

        // 處理駕照條件
        if ($request->filled('skill')) {
            $query->where('driver_license_requirements', $request->input('skill'));
        } else {
            $query->where('driver_license_requirements', 'LIKE', '%');
        }

        // 處理工作經驗條件
        if ($request->filled('conditions_exp')) {
            $query->where('conditions_exp', $request->input('conditions_exp'));
        } else {
            $query->where('conditions_exp', 'LIKE', '%');
        }

        $search_all_all = $query->get();
        //dd($search_all_all);
        return view('auth.shop_search',compact('search_all_all','search_all_all'));
        } catch(\Exception $e){
            return view('auth.error');
        }
    }
}