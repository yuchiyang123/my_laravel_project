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
    forceTLS: true,
    // 其他 Pusher 选项
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo.js';
