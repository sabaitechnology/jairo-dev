var
	fs		= require("fs")
	,http 	= require("http")
	,sio 	= require("socket.io")
	// ,util	= require("util")
;

module.exports = function rosocket(handlers){
	var me = this;
	if(!this.port) this.port = 31400;
	if(!this.host) this.host = "localjai";
	if(!this.origins) this.origins = "localjai:80";

	var ru = require("./ro.utilities.js");

	var httpServer = http.createServer(function (req, res){
		var body = "";
		req.on("data", function(data){
			body += data;
		});
		req.on("end", function(){
			var act = ru.accumulateHTTPArguments(body, req.url);
			if(handlers[act.hand]){
				handlers[act.hand](act,(function(res){
					return function(rdata){
						if(!res.headersSent) res.writeHead(200, {'Content-Type': 'text/javascript'});
						res.end(JSON.stringify(rdata, null, "\t"));
					}
				})(res));
			}else{
				res.writeHead(404, "Handler not found.", { "Content-Type": "text/javascript" });
				res.end(JSON.stringify({ error: "No appropriate handler found." }));
			}
		})

	}).listen(this.port, this.host);

	var io = sio.listen(httpServer, {
		"log level": 1
		,"origins": this.origins
	});

	io.sockets.on("connection", function(iosocket){
		iosocket.emit("sdata", { smsg: "Connected." });
		for(e in handlers){ iosocket.on(e, handlers[e]); }
	});

}
