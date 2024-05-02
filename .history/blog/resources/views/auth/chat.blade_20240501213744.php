<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var socket = io(':3000');
            var form = document.getElementById('form');
            var input = document.getElementById('message');
            var messages = document.getElementById('messages');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (input.value) {
                    // 使用AJAX提交表单数据到服务器
                    $.ajax({
                        url: '/chat_store',
                        type: 'POST',
                        data: {
                            message: input.value,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            // 保存消息成功后，通过WebSocket发送消息
                            socket.emit('chat message', input.value);
                            input.value = '';  // 清空输入框
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error saving message');
                        }
                    });
                }
            });

            socket.on('chat message', function(msg) {
                var item = document.createElement('li');
                item.textContent = msg;
                messages.appendChild(item);
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
        <input id="message" name="message">
        <input type="submit" value="送出申請" />
    </form>
</body>
</html>
