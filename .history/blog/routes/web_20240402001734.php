<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMjoinController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('home');
})->name('home');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
//揪團
Route::post('/front-view', [UserMjoinController::class, 'mjoin'])->name('front');
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
Route::post('/search-mjoin' , [UserMjoinController::class, 'search_mjoin'])->name('search_mjoin');

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


