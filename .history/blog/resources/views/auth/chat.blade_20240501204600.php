<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var socket = io(':3000');  // 確保這是正確的端口
            var form = document.getElementById('form');
            var input = document.getElementById('message');  // 修改此處以匹配 input 的 id

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (input.value) {
                    socket.emit('chat message', input.value);
                    input.value = '';
                }
            });

            socket.on('chat message', function(msg) {
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
