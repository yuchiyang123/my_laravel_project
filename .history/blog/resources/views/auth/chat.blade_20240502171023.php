<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <script>
        $(function (){  
            let socket = io.connect('http://localhost:3000/');
            socket.on('connect', function() {
                alert('Connect');
               socket.emit('chat message');
            });
        });

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
    
</head>
<body>
    <ul id="messages">
        @foreach ($messages as $message)
            <li>{{ $message->message }}</li>
        @endforeach
    </ul>
    
    @csrf
    <input id="message" name="message">  <!-- 修正 id 重複問題 -->
    <input onclick="btn_send()" type="submit" value="送出申請" />
    
</body>
<script>
      
//socket.emit('chat message', input.value);
var input = document.getElementById('message');
/*
// 当客户端连接到服务器时，输出日志
socket.on('connect', function() {
    socket.emit('OK');
    alert('Connected to server');
    console.log('Connected to server');
    console.log(socket);
});*/

// 监听来自服务器的消息事件
/*socket.on('chat message', function(message) {
    console.log('Received message: ' + message);
    // 在页面上显示消息
    var item = document.createElement('li');
    item.textContent = message;
    document.getElementById('messages').appendChild(item);
    window.scrollTo(0, document.body.scrollHeight);
});*/

function btn_send() {
    var message = input.value;
    if (message.trim() !== '') {
        $.ajax({
            url: '/chat_store',
            type: 'POST',
            data: {
                message: message,
                _token: '{{ csrf_token() }}'  // 確保 Laravel 的 CSRF 保護被滿足
            },
            success: function(data) {
                console.log('Message saved');
                input.value = '';  // 清空輸入欄位
                // 添加新消息到列表
                var item = document.createElement('li');
                /*item.textContent = message;
                document.getElementById('messages').appendChild(item);
                window.scrollTo(0, document.body.scrollHeight);*/
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error saving message');
            }
        });
    }
}
</script>
</html>
