const express = require('express');
const http = require('http');
const io = require('socket.io');

const app = express();
const server = http.createServer(app);
const socketIo = io(server);

// 處理 WebSocket 連接
socketIo.on('connection', (socket) => {
  console.log('A user connected');

  socket.on('disconnect', () => {
    console.log('User disconnected');
  });

  socket.on('chat message', (msg) => {
    socketIo.emit('chat message', msg);
  });
});

server.listen(3000, () => {
  console.log('Listening on *:3000');
});
