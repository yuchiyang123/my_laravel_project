<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function ($user) {
    // 返回 true 表示授权成功，这里可以根据实际业务逻辑来进行用户验证
    return true;
});
