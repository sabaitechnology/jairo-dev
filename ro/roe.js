
var fs		= require("fs");
var http 	= require("http");
var sio 	= require("socket.io");

(function(){
	var me = this;
	this.port = 31400;
	this.host = "localjai";
	this.origins = this.host + ":80" +" walle:80";
	this.options = {
		"log level": 1,
		"origins": this.origins
	}
	var socket = false;
	var roconf = require("./ro.conf.js");

	function error(msg){ socket ? socket.emit("sdata", { smsg: "Error: "+ msg }) : console.log("Error: "+ msg); }

	var handlers = {
		"cdata": function(cdata){
			console.log(cdata);
			socket.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
		},
		"conf": function(conf, callback){
			if(conf.set){
				roconf.set(conf.file, conf.key, conf.data, callback);
			}else{
				roconf.get(conf.file, conf.key, callback);
			}
		}
	};

// INIT

	var ju = require("./ro.utilities.js");

	var serv = http.createServer(function (req, res){
		res.writeHead(200, {'Content-Type': 'text/plain'});
		res.write("\n\tBEGIN:\n");

		res.write("Request\n");
		res.write(ju.cyclicStringify(req));

		// res.write("Response\n");
		// res.write(cyclicStringify(res));

		res.end("\n\t:END\n");
	}).listen(this.port, this.host);

	//Testing server
	http.createServer(function (req, res){
		res.writeHead(200, {'Content-Type': 'text/plain'});
		res.end("Server Two!\n");
	}).listen(this.port, "127.0.2.2");

	// Using socket.io bound to a server appears to be the only way to limit its listening to
	// a specific socket (instead of it listening on *:PORT, we want it on HOST:PORT).
	// This is fine since we want a web handler available anyhow.
	var io = sio.listen(serv, this.options);
	// var io = sio.listen(this.port, "127.0.2.1", this.options);
	io.sockets.on("connection", function(iosocket){
		socket = iosocket;
		// socket.emit("sdata", { smsg: "Connected." });
		for(e in handlers){ socket.on(e, handlers[e]); }
		// handlers.forEach(function(e){ socket.on(e.type, e.handler); });
	});

})();
