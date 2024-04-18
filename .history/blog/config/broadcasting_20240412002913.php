'connections' => [

'pusher' => [
    'driver' => 'pusher',
    'key' => env('PUSHER_APP_KEY'),
    'secret' => env('PUSHER_APP_SECRET'),
    'app_id' => env('PUSHER_APP_ID'),
    'options' => [
        'cluster' => 'ap3',
        'useTLS' => true,
    ],
],

// 其他廣播驅動程序的配置...

],
