const express = require('express');
const { createServer } = require('node:http');
const { join } = require('node:path');

const app = express();
const server = createServer(app);

app.get('/', (req, res) => {
  res.send('<h1>Hello world</h1>');
});
app.get('/', (req, res) => {
    res.sendFile(join(__dirname, 'index.blade.php'));
  });
  

server.listen(3000, () => {
  console.log('server running at http://127.0.0.1:3000');
});