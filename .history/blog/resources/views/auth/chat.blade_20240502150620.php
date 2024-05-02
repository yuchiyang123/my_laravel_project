<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>
    
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
        
    var socket = io.connect('http://localhost:3000/');
    var form = document.getElementById('form');
    var input = document.getElementById('message');
    socket.on('chat message', function(message)) {
        console.log(message);
        // 在页面上显示消息

    }

    /*form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (input.value) {
            // 使用 AJAX 提交表單數據到伺服器
            $.ajax({
                url: '/chat_store',
                type: 'POST',
                data: {
                    message: input.value,
                    _token: '{{ csrf_token() }}'  // 確保 Laravel 的 CSRF 保護被滿足
                },
                success: function(data) {
                    console.log('Message saved');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error saving message');
                }
            });
            
            console.log(socket);
            // 透過 WebSocket 發送消息
            socket.emit('chat message', input.value);
            input.value = '';  // 清空輸入欄位
        }
    });*/

    // 当客户端连接到服务器时，输出日志
    socket.on('connect', function() {
        console.log('Connected to server');
    });
    socket.emit('chat message', input.value);
    // 监听来自服务器的消息事件
    socket.on('chat message', function(msg) {
        console.log('Received message: ' + msg);
        // 在页面上显示消息
        var item = document.createElement('li');
        item.textContent = msg;
        document.getElementById('messages').appendChild(item);
        window.scrollTo(0, document.body.scrollHeight);
    });
    socket.on('chat message', function(message) {
        console.log('Received message: ' + message);
        // 在页面上显示消息
        var item = document.createElement('li');
        item.textContent = msg;
        document.getElementById('messages').appendChild(item);
        window.scrollTo(0, document.body.scrollHeight);
        
    });



    </script>
<script>
    
    function btn_send() {
        $.ajax({
            url: '/chat_store',
            type: 'POST',
            data: {
                message: input.value,
                _token: '{{ csrf_token() }}'  // 確保 Laravel 的 CSRF 保護被滿足
            },
            success: function(data) {
                console.log('Message saved');
                input.value = '';  // 清空輸入欄位
                $('#message').append(
                    '<li>' + input.value + '</li>'
                );
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error saving message');
            }
        });
    }
</script>
</html>


