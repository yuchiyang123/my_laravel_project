var app = require('express');
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('ncu-channel', function(err, count) {
  console.log('connect!');
});
redis.on('message', function(channel, notification) {
  console.log(notification);
  notification = JSON.parse(notification);
  // 將訊息推播給使用者
  io.emit('notification', notification.data.message);
});
// 監聽 3000 port
http.listen(3000, function() {
  console.log('Listening on Port 3000');
});