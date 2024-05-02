const express = require('express');
const http = require('http');
const { Server } = require("socket.io");

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: "http://127.0.0.1:8000", // 允許從 Laravel 應用的來源訪問
        methods: ["GET", "POST"],        // 允許的 HTTP 方法
        allowedHeaders: ["my-custom-header"], // 如果需要，可以指定允許的自定義頭部
        credentials: true
    }
});

io.on('connection', (socket) => {
    console.log('A user connected');
    // 你的 Socket.io 代碼
});

server.listen(3000, () => {
    console.log('Listening on *:3000');
});
