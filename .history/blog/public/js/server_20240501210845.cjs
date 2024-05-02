const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const Redis = require('ioredis');

// 建立一個 Express 應用
const app = express();
const server = http.createServer(app);

// 建立 Socket.io 伺服器
const io = socketIo(server);

// 建立與 Redis 的連接
const redis = new Redis();

// 訂閱 Redis 頻道
redis.subscribe('laravel_database_chat', (err, count) => {
    if (err) {
        console.error('Failed to subscribe: %s', err.message);
    } else {
        console.log(`Successfully subscribed to ${count} channel(s).`);
    }
});

// 當收到訊息時
redis.on('message', (channel, message) => {
    console.log('Received data:', message);
    message = JSON.parse(message);
    // 廣播到所有客戶端
    io.emit('chat message', message.data);
});

// 啟動伺服器
server.listen(3000, () => {
    console.log('Server is running on port 3000');
});
