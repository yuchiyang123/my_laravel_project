// 从 pusher-js 模块中导入 Pusher 对象
import Pusher from 'pusher-js';
// 从 laravel-echo 模块中导入 Echo 对象
import Echo from 'laravel-echo';

// 将 Pusher 对象附加到全局对象 window 上
window.Pusher = Pusher;

// 使用 Echo 对象
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
    // 其他 Pusher 选项
});

Echo.channel('mjoin_post_' + mjoinId)
    .listen('.postGoodCountUpdated', (e) => {
        // 更新相应的点赞数显示
        $('.goodcount_' + e.mjoinId).html(e.count);
        $('.goodcount_' + e.mjoinId).show();
    });
