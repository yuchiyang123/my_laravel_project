<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMjoinController;
use App\Http\Controllers\UserMessageController;
use App\Http\Controllers\UserWorkController;
use App\Http\Controllers\UserGoodController;
use App\Http\Controllers\UserArkworkController;
use App\Http\Controllers\UserCollectionsController;
use App\Http\Controllers\UserGoodArkController;


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
//創作貼文編輯表單
Route::get('/arkwork_edit/edit/{ark_id}', [UserController::class , 'arkwork_edit'])->name('arkwork_edit');
//創作貼文編輯
Route::post('/arkwork_edit_post/edit/{ark_id}', [UserController::class , 'arkwork_edit_post'])->name('arkwork_edit_post');
//創作留言
Route::post('/arkwork-reply/{ark_id}', [UserController::class, 'artwork_reply_sumbit'])->name('artwork_reply_sumbit');
//創作刪除
Route::get('/artwork_del/{ark_id}', [UserController::class, 'artwork_del'])->name('artwork_del');
//創作刪除(從全部出來)
Route::get('/artwork_del_a/{ark_id}', [UserController::class, 'artwork_del_a'])->name('artwork_del_a');
//登出
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
//按讚
Route::post('/posts/{reply_id}/{great_code}/like', [UserGoodController::class, 'click_good'])->name('posts.like');
//揪團編輯表單
Route::get('/mjoin_post_posts/edit/{mjoind}', [UserMjoinController::class, 'mjoin_edit'])->name('mjoin_edit');
//揪團編輯
Route::post('/mjoin_post_posts/edit/update/{mjoinId}', [UserMjoinController::class, 'mjoin_post_edit'])->name('mjoin_post_edit');
//揪團刪除
Route::post('/mjoin_post_posts/edit/delete/{mjoinId}', [UserMjoinController::class, 'mjoin_post_delete'])->name('mjoin_post_delete');
//揪團按讚
Route::get('/mjoin_post_posts/good/{mjoinId}', [UserGoodController::class, 'mjoin_post_good'])->name('mjoin_post_good');
//按讚取消
Route::get('/mjoin_post_posts/ungood/{mjoinId}', [UserGoodController::class, 'mjoin_post_ungood'])->name('mjoin_post_ungood');
//檢查讚
Route::get('/mjoin_post_posts/checkgood/{mjoinId}', [UserGoodController::class, 'mjoin_post_checkgood'])->name('mjoin_post_checkgood');
//揪團讚數
Route::get('/mjoin_post_posts/countgood/{mjoinId}', [UserGoodController::class, 'mjoin_post_countgood'])->name('mjoin_post_countgood');
//創作收藏
Route::get('/collect_artwork/collect/{article_id}', [UserCollectionsController::class, 'collection_artwork'])->name('collect_artwork');
//揪團收藏
Route::get('/collect_mjoin/collect/{article_id}', [UserCollectionsController::class, 'collection_mjoin'])->name('collect_mjoin');
//打工收藏
Route::get('/collect_work/collect/{article_id}', [UserCollectionsController::class, 'collection_work'])->name('collect_shop');
//創作按讚
Route::get('/art_post_posts/good/{article_id}', [UserGoodArkController::class, 'ark_post_good'])->name('ark_post_good');
//創作按讚取消
Route::get('/art_post_posts/ungood/{article_id}', [UserGoodArkController::class, 'ark_post_ungood'])->name('ark_post_ungood');
//創作檢查讚
Route::get('/art_post_posts/checkgood/{article_id}', [UserGoodArkController::class, 'ark_post_checkgood'])->name('ark_post_checkgood');
//創作讚數
Route::get('/art_post_posts/countgood/{article_id}', [UserGoodArkController::class, 'ark_post_countgood'])->name('ark_post_countgood');
//帳號註冊表單
Route::get('/user_register', function () {return view('auth.register');})->name('register');
//帳號註冊
Route::post('/user_register/submit', [UserController::class, 'user_register'])->name('register_sbmit');
//錯誤表單
Route::get('/error', function () {return view('auth.error');})->name('error');
//驗證電話表單
Route::get('/user_verify_phone', [UserController::class, 'showform'])->name('verify_phone');
//驗證電話
Route::get('/phone_verification/verify', [UserController::class, 'verify'])->name('phone_verification.verify');
//驗證電話送出簡訊
Route::get('/user_verify_phone_send/send', [UserController::class, 'sendVerificationCode'])->name('sendVerificationCode');
//驗證電話
Route::post('/user_verify_phone_submit/submit', [UserController::class, 'verify_phone'])->name('verify_phone_submit');
//驗證表單2輸入驗證碼
Route::get('/user_verify_phone_input', function () {return view('auth.verify_phone_input');})->name('verify_phone_input');

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


