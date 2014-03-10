/*
	TODO:
		Add firewall rule to block jainode service through wan port (unless enabled)
		Restrict origins if possible
		Add https/certs back in
*/

var fs 		= require("fs");
// var util 	= require("util");

(function(){
	var me = this;
	this.port = 31400;
	this.options = {
		"log level": 1,
		"origins": "localjai:80"
	}
	var socket = false;
	var jaiconf = require("./jai.conf.js");

	function error(msg){ socket ? socket.emit("sdata", { smsg: "Error: "+ msg }) : console.log("Error: "+ msg); }

	var handlers = {
		"cdata": function(cdata){
			console.log(cdata);
			socket.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
		},
		"conf": function(conf, callback){
			if(conf.set){
				// TODO: Add set functionality
				socket.emit("sdata", { smsg: "Define Set: \""+ JSON.stringify(conf) +"\"."});
				console.log(conf);
			}else{
				jaiconf.get(conf.file, conf.key, callback);
			}
		}
	};


// INIT
	var io = require("socket.io").listen(this.port, this.options);
	io.sockets.on("connection", function(iosocket){
		socket = iosocket;
		// socket.emit("sdata", { smsg: "Connected." });
		for(e in handlers){ socket.on(e, handlers[e]); }
		// handlers.forEach(function(e){ socket.on(e.type, e.handler); });
	});

})();
