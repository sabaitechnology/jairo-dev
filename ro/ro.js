/*
	TODO:
		Add firewall rule to block jainode service through wan port (unless enabled)
		Restrict origins if possible
		Add https/certs back in
		Add forking/multithreading into the server
		Split server+socket, configuration manager, and system manager into separate threads/services.
*/
var
	fs		= require("fs")
	,http 	= require("http")
	,sio 	= require("socket.io")
	// ,util	= require("util")
;

(function(){
	var me = this;
	this.port = 31400;
	this.host = "localjai";
	this.origins = this.host + ":80" +" walle:80";
	// Note: testing will require either adding an origin to the test requests
	// or providing the correct origin (or *:*) here when testing.
	this.options = {
		"log level": 1
		,"origins": this.origins
	}
	var roconf = require("./ro.conf.js");
	var ru = false;

	function error(s,msg){ s ? s.emit("sdata", { smsg: "Error: "+ msg }) : console.error("Error: "+ msg); }

	var handlers = {
		"cdata": function(cdata, callback){
			console.log(cdata);
			callback(cdata);
			if(this.emit) this.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
		}
		,"conf": function(conf, callback){
			switch(conf.type){
				case "set":{
					roconf.set(conf.file, conf.key, conf.data, callback);
					break;
				}
				case "apply": {
					break;
				}
				default: {
					roconf.get(conf.file,conf.key,callback);
				}
			}
			if(roconf[conf.type]){
			}else{
			}
		}
	};

	// We provide http access for clients that do not support socket.io
	// TODO: Add handling for set and apply functions 
	var serv = http.createServer(function (req, res){
		var body = "";
		req.on("data", function(data){
			body += data;
		});
		req.on("end", function(){
			if(!ru) ru = require("./ro.utilities.js");
			var act = ru.accumulateHTTPArguments(body, req.url);
			if(act.file){
				roconf.get(act.file, act.key, function(data){
					res.writeHead(200, {'Content-Type': 'text/javascript'});
					res.write(JSON.stringify(data, null, "\t"));
				});
			}
			res.end();
		})

	}).listen(this.port, this.host);

	// //Testing server
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
		socket.emit("sdata", { smsg: "Connected." });
		// for(e in handlers){ iosocket.on(e, handlers[e]); }
	});

})();
