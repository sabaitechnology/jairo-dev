
// var io			= require('socket.io');
var ioc = require('socket.io-client');
var cluster = require('cluster');
var util = require('util');

var pre = {
	0: "b",
	1: "kb",
	2: "mb",
	3: "gb",
	4: "tb"
}

function showMem(pid, mem){
	for(var i in mem){
		if(typeof(mem[i]) == "number"){
			var nv = mem[i];
			var j = 0;
			while( (nv - 1024) > 0 ){
				nv /= 1024;
				j++;
			}
			mem[i] = Math.round(nv) +""+ ( pre[j] || (" e"+j)  );
		}
	}
	console.log(pid +": "+ util.inspect(mem));
}

if(cluster.isMaster){
	// console.log('Forking for '+ numCPUs +' CPUs.');
	var i = require('os').cpus().length;
	while(i--) cluster.fork();
	showMem("Master", process.memoryUsage());
	// cluster.on('exit', function(worker, code, signal){ console.log('worker ' + worker.process.pid + ' died'); });
}else{
	var cs = ioc.connect("http://localjai:31400");
	console.log(process.pid +" making request.");
	cs.emit( "conf", { file: "vpnclients", key: "0.server" }, function(data){
		console.log(process.pid +" answered: "+ data);
		showMem(process.pid, process.memoryUsage());
		cs.disconnect();
		process.exit(0);
	});
}
