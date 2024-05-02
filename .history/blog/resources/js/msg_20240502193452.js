import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.io = io;
var echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});
