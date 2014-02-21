
var fs 		= require("fs");
var util 	= require("util");
var jc		= require("./jai.conf.js");

function showResult(data){ console.log("Res: "+ JSON.stringify(data, null, "\t") ); }

jc.get("vpnclients", "kitty", showResult);
// jc.get("vpnclientsTest", "kitty", showResult);
// jc.get("vpnclients", "kitty,server", showResult);
// jc.set("vpnclients", "kitty.server", "SERVER FOR OPENVPN", showResult);
// jc.get("vpnclients", "kitty", showResult);

// jc.showQueue();

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
