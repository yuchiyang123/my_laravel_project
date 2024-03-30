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
Route::get('/front-view', function (){
    return view('auth.front');
})->name('front');

Route::get('/front', [UserMjoinController::class, 'mjoin']);

Route::get('/showallmjoin/{mjoinId}','UserMjoinController@showallmjoin');

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


