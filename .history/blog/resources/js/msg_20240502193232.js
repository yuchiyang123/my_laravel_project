import Echo from 'laravel-echo';

window.io = require('socket.io-client');

let echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

const userId = window.Laravel.userId;
const otherUserId = window.Laravel.otherUserId;
const ids = [userId, otherUserId].sort();

echo.private('chat.' + ids[0] + '.' + ids[1])
    .listen('MessageSent', (e) => {
        console.log(e.message);
    });
