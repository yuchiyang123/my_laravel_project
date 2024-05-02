var app = require('express')();

var http = require('http').Server(app);

var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

http.listen(3000, function() {
    console.log('Listening to port 8005');
});
redis.subscribe('chat', function() {
    console.log('subscribed to chat channel');
});

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    console.log(message);
    if (channel == 'chat') {
        let data = message.data.data;
        let receiver_id = data.receiver_id;
        let event = message.event;

        io.emit(channel + ':' + message.event, data);
    }

    if (channel == 'group-channel') {
        let data = message.data.data;

        if (data.type == 2) {
            let socket_id = getSocketIdOfUserInGroup(data.sender_id, data.group_id);
            let socket = io.sockets.connected[socket_id];
            socket.broadcast.to('group'+data.group_id).emit('groupMessage', data);
        }
    }
});
/*const express = require('express');
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

const redisClient = new Redis({
    port: 6379,          // Redis 服务器端口
    host: '127.0.0.1',   // Redis 服务器 host
    // Redis 数据库索引
});


// 确保频道名称与 Laravel 广播的频道名称匹配
redisClient.subscribe('chat', (err, count) => {
    if (err) {
        console.error('Failed to subscribe:', err.message);
    } else {
        io.emit('chat' + count, 'Successfully subscribed to chat channel.');
        console.log(`Successfully subscribed to ${count} channel(s).`);
    }
});

redisClient.on('message', (channel, message) => {
    console.log('Received data:', message);
    try {
        const eventData = JSON.parse(message);
        if(channel=="message"){
            io.emit('chat message', eventData.data); // 修改此行
            console.log("OK");
        }else{
            console.log("NO");
        }
        
    } catch (e) {
        console.error('Error parsing message:', e);
    }
});


server.listen(3000, () => {
    console.log('Server is running on port 3000');
});*/