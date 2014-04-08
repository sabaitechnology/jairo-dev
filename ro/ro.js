var
	fs		= require("fs")
	,http 	= require("http")
	,sio 	= require("socket.io")
	,rosocket = require("./ro.socket.js")
	// ,util	= require("util")
;

(function(){
	var me = this;
	this.port = 80;
	this.host = "localjai";
	this.origins = this.host + ":80" +" walle:80";

	// var roconf = require("./ro.conf.js");

	var httpServer = http.createServer(function (req, res){
		res.writeHead(200, {'Content-Type': 'text/javascript'});
		res.write("\n\n// REQUEST BEGIN\n\n");
		res.write(JSON.stringify(arguments));
		// res.write(JSON.stringify(req));
		var body = "";
		req.on("data", function(data){
			body += data;
		});
		req.on("end", function(){
			res.write(body);
			res.write("\n\n// REQUEST END\n\n");
			// res.write(JSON.stringify(res));
			res.write(JSON.stringify(arguments));
			res.end();
		})
		// req.on("end", function(){
		// 	var act = ru.accumulateHTTPArguments(body, req.url);
		// 	if(handlers[act.hand]){
		// 		handlers[act.hand](act,(function(res){
		// 			return function(rdata){
		// 				if(!res.headersSent) res.writeHead(200, {'Content-Type': 'text/javascript'});
		// 				res.end(JSON.stringify(rdata, null, "\t"));
		// 			}
		// 		})(res));
		// 	}else{
		// 		res.writeHead(404, "Handler not found.", { "Content-Type": "text/javascript" });
		// 		res.end(JSON.stringify({ error: "No appropriate handler found." }));
		// 	}
		// })

	}).listen(this.port, this.host, function(){
		var grs = process.getgroups();
		console.log("Group: "+ process.getgid() +"\nUser: "+ process.getuid() +"\nGroups: "+ process.getgroups());
		console.log(grs);
		console.log(grs.indexOf(0));
		// Drop privileges after getting socket.
		if(process.getgid()==0)	process.setgid(1000);
		if(grs.indexOf(0)!=-1) process.setgroups([1000]);
		if(process.getuid()==0)	process.setuid(1000);
		console.log("Group: "+ process.getgid() +"\nUser: "+ process.getuid() +"\nGroups: "+ process.getgroups());
	});
	

	// rosocket.call(this,{
	// 	"cdata": function(cdata, callback){
	// 		// console.log(cdata);
	// 		callback(cdata);
	// 		if(this.emit) this.emit("sdata", { smsg: "R: \""+ JSON.stringify(cdata) +"\"."});
	// 	}
	// 	,"conf": function(conf, callback){
	// 		switch(conf.type){
	// 			case "set": {
	// 				roconf.set(conf.file, conf.key, conf.data, callback);
	// 				break;
	// 			}
	// 			case "apply": {
	// 				roconf.set(conf.file, conf.key, conf.data, callback);
	// 				break;
	// 			}
	// 			default: {
	// 				roconf.get(conf.file,conf.key,callback);
	// 			}
	// 		}
	// 	}
	// });

})();
