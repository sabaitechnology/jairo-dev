
var fs 		= require("fs");
var util 	= require("util");
var jc		= require("./jai.conf.js");

function showResult(data){ console.log("Res: "+ JSON.stringify(data, null, "\t") ); }

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
