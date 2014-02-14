var fs 		= require("fs");
//var watch	= require('watch');

function jaiconfiguration(){
	console.log("Creating conf object.");
	var me = this;
	var confRoot = "etc";
	this.conf = {};

	watch.createMonitor('list',
		function (monitor){
			monitor.on("created", function (f, stat) {
				console.log("Created: "+ f);
				for(var i in stat){
					if(!stat.hasOwnProperty(i)) continue;
					console.log("\t"+ i +": "+ stat[i] )
				}
			});
			monitor.on("changed", function (f, stat, prev) {
				console.log("Changed: "+ f);
				for(var i in stat){
					if(!stat.hasOwnProperty(i)) continue;
					if(!prev[i]){}else{
						if(prev[i]==stat[i]){
							console.log("\t"+ i +": "+ prev[i] );
						}else{
							console.log("\t"+ i +" : "+ prev[i] +" --> "+ stat[i] );
						}
					}
				}
			});
			monitor.on("removed", function (f, stat) {
				console.log("Removed: "+ f);
				for(var i in stat){
					if(!stat.hasOwnProperty(i)) continue;
					console.log("\t"+ i +": "+ stat[i] );
				}
			});
		}
	);

/*
	this.load = function(section, callback){
		console.log("Loading "+ section +".");
		if(!me.conf[section]){
			console.log("Trying to load "+ confRoot + "jai."+ section +".js.");
			fs.readFile(confRoot + "jai."+ section +".js", function(e, data){
				if(!e){
					console.log("Trying load.");
					me.parse(section, data, callback);
				}else{
					console.log("Load error. Details: "+ JSON.stringify(e) +"\n");
				}
			});
		}else{
			console.log("Section already loaded.");
		}
	}
	this.parse = function(section, sectionData, callback){
		console.log("Parsing "+ section +".");
		try {
			console.log("Trying parse.");
			me.conf[section] = JSON.parse(sectionData);
		} catch(e){
			console.log("Parse failed.");
			console.log("Error details: "+ JSON.stringify(e) +"\n");
//			console.log(util.inspect(e, { depth: null }))
			me.conf[section] = false;
		}
		console.log("Parse stat: "+ (me.conf[section]==true) +".");
		if(me.conf[section] && callback) callback();
	}
	this.set = function(section, key, value, callback){
		if(value == null){
			console.log("No value supplied to set.");
			if(callback) callback(false);
		}else{
			if(!me.conf[section]){
				me.load(section, function(){ me.set(section, key, value, callback); });
			}else{
				var obj = me.conf[section];
				key = key.split('.');
				var len = key.length;
				for (var i = 0; i < len - 1; i++){ obj = obj[key[i]]; }	// TODO: while not for?
				obj[key[len - 1]] = value;
				if(callback) callback(true);
			}
		}
	}
	this.get = function(section, key, callback){
		if(section == null){
			console.log("No section specified in get arguments.");
		}else{
			if(!me.conf[section]){
				console.log("Deferring get.");
				me.load(section, function(){ me.get(section, key, callback); });
			}else{
				console.log("Running get.");
				if(key == null){
					if(callback) callback(me.conf[section]);
				}else{
					var obj = me.conf[section];
					key = key.split('.');
					var len = key.length;
					for (var i = 0; i < len - 1; i++){ obj = obj[key[i]]; }	// TODO: while not for?
					if(callback) callback(obj[key[len - 1]]);
				}
			}
		}
	}
*/
}

module.exports = new jaiconfiguration();