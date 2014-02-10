
var fs 		= require("fs");
var util 	= require("util");
// var jc		= require("./jaiconf.js");
var q = require("./jai.queue.js");

// setTimeout(function(){ q.add('a', function(){ console.log("A ran."); }) }, 500);
// setTimeout(function(){ q.add('a', function(){ console.log("A ran."); }) }, 500);
// setTimeout(function(){ q.add('a', function(){ console.log("A ran."); }) }, 500);
// setTimeout(function(){ q.add('a', function(){ console.log("A ran."); }) }, 500);
// setTimeout(function(){ q.add('a', function(){ console.log("A ran."); }) }, 500);
// setTimeout(function(){ q.add('a', function(){ console.log("A ran."); }) }, 500);

var lock = false;
var check = false;
setTimeout(function(){
	console.log("Lock.");
	lock = true;
	setTimeout(function(){
		console.log("Unlock.");
		lock = false;
	}, 500);
	var check = setInterval(function(){
		if(!lock){
			console.log("Unlocked!");
			clearInterval(check);
		}else{
			console.log("Waiting for lock...");
		}
	}, 100);
}, 100);



// function runTasks(lastResult, taskList, resultList, isRunning, finalCall){
// 	if(isRunning) resultList.push(lastResult);
// 	if(taskList.length > 0){
// 		var nextTask = taskList.shift();
// 		nextTask(function(nextResult){ runTasks(nextResult, taskList, resultList, true, finalCall); });
// 	}else{
// 		finalCall(resultList);
// 	}
// }

// jc.get("vpnclients", "kitty.server",function(data){
//  	console.log("Res: "+ JSON.stringify(data, null, "\t") );
// });

// jc.set("vpnclients", "kitty.server", "SERVER FOR OPENVPN");
// setTimeout(
// 	function(){

// runTasks(null, [
// 	function(callback){ jc.get("vpnclients", "kitty.server", callback); },
// 	function(callback){ jc.set("vpnclients", "kitty.server", "1.2.3.4", callback); },
// 	function(callback){ jc.get("vpnclients", "kitty.server", callback); }
// ],
// [], false, function(res){
// 	console.log("Res2: "+ JSON.stringify(res, null, "\t") );
// });

// 	},
// 	2000
// );

// setData(conf, "vpnclients.kitty", { "type": "l2tp", "server": "1.2.3.4", "username": "dave" });

// console.log( JSON.stringify(jc, null, "\t") );


// for(var i in conf){
// 	fs.writeFileSync(confroot +"jai."+ i +".js", JSON.stringify(conf[i], null, "\t"));
// //	console.log( JSON.stringify(conf[i], "\t", 1) );
// }
