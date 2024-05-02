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
        let counter = 0;
    
        const socket = io({
          ackTimeout: 10000,
          retries: 3,
          auth: {
            serverOffset: 0
          }
        });
    
        const form = document.getElementById('form');
        const input = document.getElementById('input');
        const messages = document.getElementById('messages');
    
        form.addEventListener('submit', (e) => {
          e.preventDefault();
          if (input.value) {
            const clientOffset = `${socket.id}-${counter++}`;
            socket.emit('chat message', input.value, clientOffset);
            input.value = '';
          }
        });
    
        socket.on('chat message', (msg, serverOffset) => {
          const item = document.createElement('li');
          item.textContent = msg;
          messages.appendChild(item);
          window.scrollTo(0, document.body.scrollHeight);
          socket.auth.serverOffset = serverOffset;
        });
      </script>
</body>
</html>
