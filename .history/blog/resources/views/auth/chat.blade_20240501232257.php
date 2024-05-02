<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var socket = io(':3000');
            var form = document.getElementById('form');
            var input = document.getElementById('message');

            form.addEventListener('submit', function(e) {
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

                    // 透過 WebSocket 發送消息
                    console.log(socket);
                    socket.emit('chat message', input.value);
                    input.value = '';  // 清空輸入欄位
                }
            });
            

            socket.on('chat message', function(msg) {
                // 在頁面上顯示消息
                console.log('有');
                var item = document.createElement('li');
                item.textContent = msg;
                document.getElementById('messages').appendChild(item);
                window.scrollTo(0, document.body.scrollHeight);
            });
        });

    </script>
</head>
<body>
    <ul id="messages">
        @foreach ($messages as $message)
            <li>{{ $message->message }}</li>
        @endforeach
    </ul>
    <form id="form" action="/chat_store" method="post">
        @csrf
        <input id="message" name="message">  <!-- 修正 id 重複問題 -->
        <input type="submit" value="送出申請" />
    </form>
</body>
</html>
