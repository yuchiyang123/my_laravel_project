<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redis;
use App\Events\MessageSent;

// 在路由或控制器中处理 WebSocket 连接
Route::get('/chat', function () {
    return view('chat');
});

// 处理消息发送
Route::post('/chat/send', function () {
    $message = request()->input('message');
    // 存储消息到 Redis
    Redis::publish('chat', json_encode(['message' => $message]));
    return response()->json(['status' => 'Message sent!']);
});

// 监听 Redis 中的消息，并广播到前端
Redis::subscribe(['chat'], function ($message) {
    // 广播消息到前端
    event(new MessageSent(json_decode($message, true)['message']));
});
