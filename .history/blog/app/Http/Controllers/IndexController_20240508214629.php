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
            $a = UserPostArkwork::all();
            $m = UserPostMjoin::all();
            $s = UserPostWork::all();

            return view('auth.index',compact('a','m','s'));
        }catch(\Exception $e){
        
            return view('auth.error');
        }
    }

    public function search(Request $request){
        try{
            $search = $request->location;
            $search_all = UserPostMjoin::where('destination',$search)->get();
            $search_all_all = $search_all->merge(UserPostWork::where('selectwhere',$search)->get());
            return view('auth.index',compact('search_all_all'));
        } catch(\Exception $e){

        }
    }
}