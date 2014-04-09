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
	,rosocket = require("./ro.socket.js")
	// ,util	= require("util")
;

(function(){
	var me = this;
	var opts = require("./conf/ro.options.json");

 	this.port = opts.port;
 	this.host = opts.host;
 	this.origins = this.host + ":80" +" walle:80";

	var roconf = require("./ro.conf.js");

rosocket.call(this,{
	"cdata": function(cdata, callback){
		// console.log(cdata);
		callback(cdata);
		if(this.emit) this.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
	}
	,"conf": function(conf, callback){
		switch(conf.type){
			case "set": {
				roconf.set(conf.file, conf.key, conf.data, callback);
				break;
			}
			case "apply": {
				roconf.set(conf.file, conf.key, conf.data, callback);
				break;
			}
			default: {
				roconf.get(conf.file,conf.key,callback);
			}
		}
	}
});

})();
