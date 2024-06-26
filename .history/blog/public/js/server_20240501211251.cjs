const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const Redis = require('ioredis');
const cors = require('cors');  // 引入 cors 中間件

const app = express();
app.use(cors());  // 使用 cors 中間件，允許所有跨域請求

const server = http.createServer(app);
const io = socketIo(server, {
    cors: {
        origin: "http://127.0.0.1:8000",  // 允許來自此來源的連接
        methods: ["GET", "POST"],  // 允許的 HTTP 方法
        allowedHeaders: ["my-custom-header"],
        credentials: true
    }
});

const redis = new Redis();

redis.subscribe('laravel_database_chat', (err, count) => {
    if (err) {
        console.error('Failed to subscribe:', err.message);
    } else {
        console.log(`Successfully subscribed to ${count} channel(s).`);
    }
});

redis.on('message', (channel, message) => {
    console.log('Received data:', message);
    message = JSON.parse(message);
    io.emit('chat message', message.data);
});

server.listen(3000, () => {
    console.log('Server is running on port 3000');
});
