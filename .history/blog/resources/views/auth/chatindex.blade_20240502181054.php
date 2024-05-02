<!-- resources/views/chat.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Socket.IO chat</title>
    <style>
        /* 样式表 */
    </style>
</head>
<body>
    <ul id="messages">
        @foreach ($messages as $message)
            <li>{{ $message->content }}</li>
        @endforeach
    </ul>
    <form id="form" action="/chat_store" method="post">
        @csrf
        <input id="input" name="message" autocomplete="off" />
        <button type="submit">Send</button>
    </form>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    <script>
        /* 前端 JavaScript 代码 */
    </script>
</body>
</html>
