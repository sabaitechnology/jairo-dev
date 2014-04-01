/*
	TODO:
		Add firewall rule to block jainode service through wan port (unless enabled)
		Restrict origins if possible
		Add https/certs back in
		Add forking/multithreading into the server
*/

var fs		= require("fs");
var http 	= require("http");
var sio 	= require("socket.io");


// var util 	= require("util");

(function(){
	var me = this;
	this.port = 31400;
	this.host = "localjai";
	// this.origins = this.host + ":80" +" walle:80";
	// this.origins = "*.*";
	this.options = {
		"log level": 1
		// ,"origins": this.origins
	}
	// var socket = false;
	var roconf = require("./ro.conf.js");
	var ru = false;

	function error(s,msg){ s ? s.emit("sdata", { smsg: "Error: "+ msg }) : console.log("Error: "+ msg); }

	var handlers = {
		"cdata": function(cdata, callback){
			console.log(cdata);
			callback(cdata);
			if(this.emit) this.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
		},
		"conf": function(conf, callback){
			if(roconf[conf.type]){
				roconf[conf.type].call(roconf, conf.file, conf.key, conf.data, callback);
			}else{
				roconf.get(conf.file,conf.key,callback);
			}
		}
	};

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
					// res.write( typeof(data) );
					res.end();
				});
			}else{
				res.end();
			}
			// if(handlers[act.kind]){
			// 	handlers[act.kind](act, function(data){
			// 		res.writeHead(200, {'Content-Type': 'text/javascript'});
			// 		res.write(data);
			// 		res.end();
			// 	});
			// }else{
			// 	res.writeHead(200, {'Content-Type': 'text/javascript'});
			// 	// res.write("// act:\n"+ JSON.stringify(act) +"\n// :act\n");
			// 	res.end();
			// }
			// res.writeHead(200, {'Content-Type': 'text/javascript'});
			// res.write("// BEGIN\n");
			// res.write("// Action URL:\n"+ JSON.stringify(act) +"\n:ACT\n");

			// // res.write("// BODY ("+ body.length +"):\n"+ body +"\n:BODY\n");
			// // res.write(req.url +"\n");
			// // res.write(JSON.stringify(q) + "\n");
			// res.end("// END\n");
		})

	}).listen(this.port, this.host);

	// //Testing server
	// http.createServer(function (req, res){
	// 	res.writeHead(200, {'Content-Type': 'text/plain'});
	// 	res.end("Server Two!\n");
	// }).listen(this.port, "127.0.2.2");

	// Using socket.io bound to a server appears to be the only way to limit its listening to
	// a specific socket (instead of it listening on *:PORT, we want it on HOST:PORT).
	// This is fine since we want a web handler available anyhow.
	var io = sio.listen(serv, this.options);
	// var io = sio.listen(this.port, "127.0.2.1", this.options);

	io.sockets.on("connection", function(iosocket){
		// socket = iosocket;
		// socket.emit("sdata", { smsg: "Connected." });
		for(e in handlers){ iosocket.on(e, handlers[e]); }

		// iosocket.on("cdata", testInput, iosocket);

		// handlers.forEach(function(e){ socket.on(e.type, e.handler); });
	});

})();
