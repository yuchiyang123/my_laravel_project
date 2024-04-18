const mix = require('laravel-mix');

// 设置 Pusher 的环境变量
process.env.MIX_PUSHER_APP_KEY = '4f4912ad1af008f1b005';
process.env.MIX_PUSHER_APP_CLUSTER = 'ap3';

mix.js('resources/js/echo.js', 'public/js')
