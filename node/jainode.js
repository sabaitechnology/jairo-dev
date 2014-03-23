/*
	TODO:
		Add firewall rule to block jainode service through wan port (unless enabled)
		Restrict origins if possible
		Add https/certs back in
*/

var fs		= require("fs");
var http 	= require("http");
var sio 	= require("socket.io");

// var util 	= require("util");

(function(){
	var me = this;
	this.port = 31400;
	this.host = "localjai";
	this.origins = this.host + "80";
	this.options = {
		"log level": 1,
		"origins": this.origins
	}
	// var socket = false;
	// var jaiconf = require("./jai.conf.js");

	// function error(msg){ socket ? socket.emit("sdata", { smsg: "Error: "+ msg }) : console.log("Error: "+ msg); }

	// var handlers = {
	// 	"cdata": function(cdata){
	// 		console.log(cdata);
	// 		socket.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
	// 	},
	// 	"conf": function(conf, callback){
	// 		if(conf.set){
	// 			jaiconf.set(conf.file, conf.key, conf.data, callback);
	// 		}else{
	// 			jaiconf.get(conf.file, conf.key, callback);
	// 		}
	// 	}
	// };

// INIT

	var serv = http.createServer(function (req, res){
		res.writeHead(200, {'Content-Type': 'text/plain'});

		res.write("Request\n");
		res.write(JSON.stringify(req));

		res.write("Request\n");
		res.write(JSON.stringify(req));

		// console.log("req:");
		// console.log(req);

		// console.log("res:");
		// console.log(res);

		res.end('Hello World\n');
	});

	serv.listen(this.port, this.host);

	// var io = sio.listen(this.port, this.options);
	// io.sockets.on("connection", function(iosocket){
	// 	socket = iosocket;
	// 	// socket.emit("sdata", { smsg: "Connected." });
	// 	for(e in handlers){ socket.on(e, handlers[e]); }
	// 	// handlers.forEach(function(e){ socket.on(e.type, e.handler); });
	// });

})();
