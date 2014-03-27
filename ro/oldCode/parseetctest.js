
var fs 		= require("fs");
var util 	= require("util");
var jc		= require("./jai.conf.js");

function showResult(data){ console.log("Res: "+ JSON.stringify(data, null, "\t") ); }

var conf = {
	file: 'vpnclients',
	key: 0,
	data: {
		type: 'pptp',
		server: '203.54.1.20',
		username: 'chinacat',
		password: 'meowmeow',
		name: 'kittycat'
	},
	set: true
};

jc.set(conf.file, conf.key, conf.data, showResult);
// jc.get(conf.file, conf.key, showResult);


// jc.get("vpnclients", "kitty", showResult);
// jc.set("vpnclients", "kitty.server", "SERVER FOR OPENVPN", showResult);
// jc.set("vpnclients", "kitty.password", "PASSWORD FOR OPENVPN", showResult);
// jc.get("vpnclients", "kitty", showResult);
// jc.diff("vpnclients", showResult);
// jc.get("vpnclients", "kitty.server", showResult);
// jc.set("vpnclients", "kitty.server", "SERVER FOR OPENVPN", showResult);
// jc.get("vpnclients", "kitty.server", showResult);
// 
// jc.revert("vpnclients", showResult);
// jc.diff("vpnclients", showResult);
// jc.get("vpnclients", "kitty.server", showResult);
