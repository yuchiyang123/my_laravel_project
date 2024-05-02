const express = require('express'); 
const app = express(); 
const http = require('http'); 
const { Server } = require('socket.io'); 
const { createServer } = require("http"); 
const server = http.createServer(app); 
const httpServer = createServer(app); 
const io = require('socket.io')(server, {   
     cors: { origin: "*"} });  
     app.get('/', (req, res) => {     
          res.send('<h1>Hello world</h1>');   
});     
io.on('connection',(socket)=>{     
     console.log('connection');   
   
     socket.on('disconnect',(socket)=>{             
        console.log('Disconnect');     
}); 
})  
server.listen(3000, () => {   
     console.log('Server is running'); 
});