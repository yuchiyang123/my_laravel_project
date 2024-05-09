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
use App\Models\Artwork_reply;
use Illuminate\Http\Request;
use App\Models\UserGood;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Messaging\CloudMessage;
use App\Models\User_phone;
use App\Models\MjoinScore;
use App\Models\User_notify_mjoin;
use App\Models\User_join_mjoin;
use App\Models\UserPostMjoin;
use App\Models\WorkScore;
use App\Models\Shop_join;
use App\Models\UserPostWork;

use function Laravel\Prompts\alert;
use function Symfony\Component\HttpKernel\Log\record;

class AdminController extends Controller
{
    public function admin_index()
    {
        return view('admin.index2');
    }

    public function user_auth()
    {
        $users = User::leftJoin('user_phone', 'user.id', '=', 'user_phone.user_id')
              ->select('user.*', 'user_phone.phone')
              ->get();
        //$user_phone = User_phone::where('user_id',$users)->get();
        return view('admin.user_auth',compact('users'));
    }
    public function user_cms(Request $request)
    {
        $mjoins = UserPostMjoin::all();
        $shops = UserPostWork::all();
        $artworks = UserPostArkwork::all();
        $artworks->transform(function ($artwork) {
            $user = User::find($artwork->user_id);
            $artwork->username = $user ? $user->username : 'N/A';
            return $artwork;
        });
        return view('admin.user_cms',compact('mjoins','shops','artworks'));
    }
    //加入
        public function user_join()
    {
        // 獲取所有的 UserPostMjoin
        $mjoins = UserPostMjoin::all();

        // 定義一個空陣列用於存儲加入者的頭像資訊
        $joiners = [];

        // 遍歷每一篇文章，查詢其加入者
        foreach ($mjoins as $mjoin) {
            // 查詢這篇文章的加入者
            $joiners[$mjoin->id] = User_join_mjoin::where('article_id', $mjoin->id)->get();

            // 遍歷這篇文章的加入者
            foreach ($joiners[$mjoin->id] as $joiner) {
                // 查詢加入者的用戶信息
                $user = User::find($joiner->user_id);

                // 如果找到了用戶
                if ($user) {
                    // 設置用戶名
                    $joiner->username = $user->username;
                    // 設置用戶頭像相對路徑
                    $joiner->profile_image = $user->profileImage;
                    // 設置用戶頭像類型
                    $joiner->profile_image_type = $user->profileImage_type;
                    // 如果頭像路徑存在，則組合成完整的 URL
                    if ($joiner->profile_image) {
                        $joiner->profile_image_url = 'data:' . $joiner->profile_image_type . ';base64,' . base64_encode($joiner->profile_image);
                    } else {
                        // 如果頭像路徑不存在，設置為默認頭像的 URL
                        $joiner->profile_image_url = 'https://github.com/mdo.png';
                    }
                } else {
                    // 如果未找到用戶，設置用戶名為 N/A
                    $joiner->username = 'N/A';
                    // 設置頭像路徑為 null
                    $joiner->profile_image = null;
                    // 設置頭像類型為 null
                    $joiner->profile_image_type = null;
                    // 設置頭像 URL 為默認頭像的 URL
                    $joiner->profile_image_url = 'https://github.com/mdo.png';
                }
            }
        }

        // 遍歷每一篇文章，查詢其作者的頭像資訊
        $mjoins->transform(function ($mjoin) {
            // 查詢用戶信息
            $user = User::find($mjoin->posted_by_u);
            // 如果找到了用戶
            if ($user) {
                // 設置用戶名
                $mjoin->username = $user->username;
                // 設置用戶頭像相對路徑
                $mjoin->profile_image = $user->profileImage;
                // 設置用戶頭像類型
                $mjoin->profile_image_type = $user->profileImage_type;
                // 如果頭像路徑存在，則組合成完整的URL
                if ($mjoin->profile_image) {
                    $mjoin->profile_image_url = 'data:' . $mjoin->profile_image_type . ';base64,' . base64_encode($mjoin->profile_image);
                } else {
                    // 如果頭像路徑不存在，設置為默認頭像的URL
                    $mjoin->profile_image_url = 'https://github.com/mdo.png';
                }
            } else {
                // 如果未找到用戶，設置用戶名為 N/A
                $mjoin->username = 'N/A';
                // 設置頭像路徑為 null
                $mjoin->profile_image = null;
                // 設置頭像類型為 null
                $mjoin->profile_image_type = null;
                // 設置頭像URL為默認頭像的URL
                $mjoin->profile_image_url = 'https://github.com/mdo.png';
            }
            return $mjoin;
        });

        // 將所有處理好的資料傳遞到視圖中
        return view('admin.user_join',compact('joiners','mjoins'));
    }

}