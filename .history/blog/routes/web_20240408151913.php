<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMjoinController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\UserWorkController;
use App\Http\Controllers\UserArkworkController;

use function Illuminate\Filesystem\name;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
//揪團
Route::get('/front-view', [UserMjoinController::class, 'mjoin'])->name('front');
//揪團資料庫
Route::get('/front', [UserMjoinController::class, 'mjoin']);
//留言插入
Route::post('/front-reply-submit/{mjoinid}', [UserMjoinController::class, 'mjoin_reply_sumbit'])->name('front.reply.submit');
//揪團留言資料庫
Route::get('/front-reply/{mjoinId}', [UserMjoinController::class, 'mjoin_reply']);
//揪團留言數
Route::get('/front-reply-count/{mjoinId}', [UserMjoinController::class, 'mjoin_reply_count']);
//揪團貼文按讚
Route::get('/front-good/{mjoinId}', [UserMjoinController::class, 'mjoin_c_good']);
//揪團發文連結表單
Route::post('/mjoin_post_form' ,function(){
    return view('auth.Mjoinform');
})->name('mjoin_post_form');
//揪團發文
Route::post('/mjoin_post_posts' , [UserMjoinController::class, 'mjoin_post'])->name('mjoin_post_posts');
//搜尋揪團
Route::get('/search-mjoin' , [UserMjoinController::class, 'search_mjoin'])->name('search_mjoin');
//訊息一開始的
Route::get('/message-view/index', function () {
    return view('auth.Message');
})->name('Message');
//訊息顯示
Route::get('/message-view-show',[UserMessageController::class , 'message_show'])->name('message_view_show');
//訊息單獨顯示
//Route::get('/message-view-show/{senderu}', [UserMessageController::class, 'message_show_solo'])->name('message_view_solo');

Route::get('/message-view-show/t/{senderu}', [UserMessageController::class , 'message_d'])->name('message_d');
//訊息傳送
Route::post('/message-submit/{senderu}/{receiveru}/{receivere}', [UserMessageController::class, 'message_submit'])->name('message_submit');
//打工發文連結表單
Route::get('/work_post_form' ,function(){
    return view('auth.Workform');
})->name('work_post_form');
//打工發文
Route::post('/work_post_posts' , [UserWorkController::class, 'work_post'])->name('work_post_posts');
//創作發文表單連結
Route::get('/arkwork_post_form' ,function(){
    return view('auth.Arkworkform');
})->name('arkwork_post_form');
//創作發文
Route::post('/arkwork_post_posts' , [UserArkworkController::class, 'arkwork_post'])->name('arkwork_post_posts');
//用戶介面
Route::get('/user-profile/index' ,function(){
    return view('auth.userprofile');
})->name('/user-profile/index');
//用戶全部
Route::get('/user-profile/index/d/{username}', [UserController::class , 'user_data'])->name('user_profile_d');
//用戶貼文全部顯示
Route::get('/arkwork_all/a/{username}', [UserController::class , 'user_artwork_all'])->name('arkwork_all');
//用戶貼文單獨顯示
Route::get('/arkwork_solo/solo/{ark_id}', [UserController::class , 'arkwork_solo'])->name('arkwork_solo');
//貼文編輯
Route::get('/arkwork_edit/edit/{ark_id}', [UserController::class , 'arkwork_solo'])->name('arkwork_solo');

Route::get('/showallmjoin/{mjoinId}',[UserMjoinController::class, 'showallmjoin']);

Route::post('/login', [UserController::class, 'login'])->name('user.login');

//測試連接MySQL
Route::get('/test-db-connection', function () {
    try {
        DB::connection()->getPdo();
        echo "Connected successfully to the database!";
    } catch (\Exception $e) {
        die("Could not connect to the database: " . $e->getMessage());
    }
});


