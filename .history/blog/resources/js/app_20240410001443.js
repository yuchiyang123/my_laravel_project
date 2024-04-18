import './bootstrap';
import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.io = io;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001' // 或者你的 WebSocket 服務器的主機名稱和端口
});