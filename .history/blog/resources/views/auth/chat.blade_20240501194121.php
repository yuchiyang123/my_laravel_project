<!DOCTYPE html>
<html>
<head>
    <title>Chat Room</title>
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var socket = io(':3000');
            var form = document.getElementById('form');
            var input = document.getElementById('input');

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
    <form id="form" action="{{ url('/chat_store') }}" method="POST">
        @csrf
        <input id="input" autocomplete="off" name="message"><button type="submit">Send</button>
    </form>
</body>
</html>
