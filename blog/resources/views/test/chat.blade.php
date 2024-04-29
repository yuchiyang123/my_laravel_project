<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script>
</head>
<body>
    <div id="messages"></div>
    <form id="messageForm">
        <input type="text" id="messageInput" placeholder="Type your message here...">
        <button type="submit">Send</button>
    </form>

    <script>
        var socket = io('http://localhost:3000'); // 与 Laravel Echo Server 连接
        var messages = document.getElementById('messages');

        // 接收消息并显示在页面上
        socket.on('message', function(data) {
            messages.innerHTML += '<p>' + data + '</p>';
        });

        // 发送消息
        document.getElementById('messageForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var messageInput = document.getElementById('messageInput');
            var message = messageInput.value;
            socket.emit('message', message);
            messageInput.value = '';
        });
    </script>
</body>
</html>
