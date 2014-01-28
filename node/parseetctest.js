
var fs 		= require('fs');
var util 	= require('util');

var confroot = "../jai/etc/";

function loadConfig(){
	var etc = false;
	try {
			etc = JSON.parse(fs.readFileSync(confroot + "etc.js"))
	}
	catch(e) {
			console.log(util.inspect(e, { depth: null }))
			// throw(e); // Throwing this crashes our node.js instance.
	}
	return etc;
}




var conf = loadConfig();
for(var i in conf){
	fs.writeFileSync(confroot +"jai."+ i +".js", JSON.stringify(conf[i], "\t", 1));
//	console.log( JSON.stringify(conf[i], "\t", 1) );
}
