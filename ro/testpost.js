#!/usr/local/bin/node

var querystring = require("querystring");

var http = require("http");

var data = { file: "vpnclients", key: "0.server" };

var r = http.request({
	hostname: "localjai",
	port: "31400",
	path: "/", //+ querystring.stringify(data),
	method: "POST" // ( data ? "POST" : "GET" )
}, function(res) {
	var rd = "";
	// res.setEncoding("utf8");
	res.on("data", function (chunk){
		process.stdout.write(".");
		rd += chunk;
	});
	res.on("end", function(){
		console.log("Done!");
		console.log("Result:");
		console.log(rd);
	});
}).on("error", function(e){
	console.error("There was a problem with the request:\n");
	console.error(e);
	process.exit(1);
})

var txt = JSON.stringify(data);

console.log("Posting: "+ txt);

r.write(txt +"\n\n");
// r.write("\n\n");

r.end();
