var io = require('socket.io-client');
// 建立 socket.io 的連線
var notification = io.connect('http://localhost:3000');
// 當從 socket.io server 收到 notification 時將訊息印在 console 上
notification.on('notification', function(message) {
  console.log(message);
});