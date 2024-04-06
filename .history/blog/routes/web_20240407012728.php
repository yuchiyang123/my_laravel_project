<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMjoinController;
use App\Http\Controllers\UserMessageController;

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
//打工發文
Route::post('/work_post_posts' , [UserWorkController::class, 'work_post'])->name('work_post_posts');

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


