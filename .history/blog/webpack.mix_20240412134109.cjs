const mix = require('laravel-mix');

// 设置 Pusher 的环境变量
process.env.MIX_PUSHER_APP_KEY = '4f4912ad1af008f1b005';
process.env.MIX_PUSHER_APP_CLUSTER = 'your_pusher_app_cluster';

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/bootstrap.js', 'public/js');
