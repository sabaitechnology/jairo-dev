var fs 		= require("fs");
var watch	= require('watch');

function jaiconfiguration(){
	var me = this;
	var confRoot = "etc";


	this.load = function(file, callback){
		console.log(file +" loading.");
		fs.readFile(confRoot + file, function(e, data){
			if(!e){
				console.log(file +" parsing.");
				try {
					data = JSON.parse(data);
				}catch(e){
					console.log(file + " parse error: "+ JSON.stringify(e) +"\n");
					data = false;
					// console.log(util.inspect(e, { depth: null }))
				}
				console.log(file +"parsed.");
				if(data && callback) callback(file, data);
			}else{
				console.log(file +" error: "+ JSON.stringify(e) +"\n");
			}
		});
	}

	// this.get = function(file, key, callback){
	// 	if(file == null){
	// 		console.log("No file specified in get arguments.");
	// 	}else{
	// 		if(!me.conf[file]){
	// 			console.log("Deferring get.");
	// 			me.load(file, function(){ me.get(file, key, callback); });
	// 		}else{
	// 			console.log("Running get.");
	// 			if(key == null){
	// 				if(callback) callback(me.conf[file]);
	// 			}else{
	// 				var obj = me.conf[file];
	// 				key = key.split('.');
	// 				var len = key.length;
	// 				for (var i = 0; i < len - 1; i++){ obj = obj[key[i]]; }	// TODO: while not for?
	// 				if(callback) callback(obj[key[len - 1]]);
	// 			}
	// 		}
	// 	}
	// }

	// this.set = function(file, key, value, callback){
	// 	if(value == null){
	// 		console.log("No value supplied to set.");
	// 		if(callback) callback(false);
	// 	}else{
	// 		if(!me.conf[file]){
	// 			me.load(file, function(){ me.set(file, key, value, callback); });
	// 		}else{
	// 			var obj = me.conf[file];
	// 			key = key.split('.');
	// 			var len = key.length;
	// 			for (var i = 0; i < len - 1; i++){ obj = obj[key[i]]; }	// TODO: while not for?
	// 			obj[key[len - 1]] = value;
	// 			if(callback) callback(true);
	// 		}
	// 	}
	// }

	// var fw = fs.watch('etc', function (event, filename){
	// 	console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event));
	// });

}

module.exports = new jaiconfiguration();