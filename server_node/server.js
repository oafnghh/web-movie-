const express = require('express')
const app = express();
const axios = require('axios');
const server = require('http').createServer(app);
const io = require('socket.io')(server, {
    cors: { origin: "*" }
})

io.on('connection', (socket) => {
    console.log('connection');
    socket.on('sendChatToServer', (message, nameUser) => {
        io.sockets.emit('sendChatToClient', message, nameUser);
    });
    socket.on('disconnect', (socket) => {
        console.log('Disconnect')
    });
})

server.listen(3000, () => {
    console.log('server is running');
})