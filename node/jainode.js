/*
	TODO: Add firewall rule to block jainode service through wan port (unless enabled)
*/
var fs = require('fs');

var io = require('socket.io').listen(31400, {
	"log level": 1,
	"origins": "*:80"
});

io.sockets.on('connection', function(socket){
//	socket.emit('sdata', { smsg: 'Connected.' }); // sends message to client signaling connection established

	socket.on('cdata', function(cdata){		// Binds handler for receiving client messages
		// When a message from the client arrives, send a receipt message; this is really for debugging
		socket.emit('sdata', { smsg: 'I received your message: "'+ cdata.cmsg +'".'});
	});
});
