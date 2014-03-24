var fs 		= require("fs");
// var util	= require("util");

module.exports = (function(){
	var me = this;
	var filePath = "conf/etc";

	var deepdiff = false;
	// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });

var ops = {
	get: {
		runner: function (file, key, callback){
			ops.load.runner(file, true, function(temp){
				if(!temp){
					ops.load.runner(file, false, function(conf){
						if(!conf) conf = {};
						callback(ops.getKey.runner(conf,key));
					});
				}else{
					callback(ops.getKey.runner(temp,key));
				}
			});
		},
		scheduler: function(file, key, callback){
			if(!file) return;
			if(!callback && (typeof(key) == "function")){ callback = key; key = null; }
			if(!callback) return; // TODO: throw an error?
			q.schedule({ type: "get", callback: callback, args: [ file, key ] });
		}
	},
	set: {
		runner: function (file, key, value, callback){
			if(key == null){
				ops.save.runner(file,value,callback);
			}else{
				ops.get.runner(file, null, function(data){
					if(!data) data = {};
					var obj = data;
					if( (typeof(key) != "string") && (key != null) ) key = key.toString();
					key = key.split('.');
					var len = key.length;
					for(var i=0; i<(len-1); i++){
						if(!obj[key[i]]) obj[key[i]] = {};
						obj = obj[key[i]];
					}
					if(obj[key[len-1]] == value){ // Don't bother writing file if value isn't going to change.
						callback(true);
					}else{
						obj[key[len-1]] = value;
						ops.save.runner(file,data,callback);
					}
				});
			}
		},
		scheduler: function(file, key, value, callback){
			if(!file) return;
			if(!callback && (typeof(value) == "function")){ callback = value; value = key; key = null; }
			if(key == null) key = "";
			if(value == null) value = ""; // Test for null, value may legitimately be false.
			q.schedule({ type: "set", callback: callback, args: [ file, key, value ] });
		}
	},
	diff: {
		runner: function(file, callback){
			ops.load.runner(file, true, function(temp){
				ops.load.runner(file, false, function(conf){
					if(!conf) conf = {};
					if(!temp) temp = conf;
					if(!deepdiff) deepdiff = require("deep-diff");
					callback((deepdiff.diff(temp,conf) || []),temp,conf);
				});
			});
		},
		scheduler: function(file, callback){
			if(!file || !callback) return;
			q.schedule({ type: "diff", callback: callback, args: [ file ] })
		}
	},
	revert: {
		runner: function(file, key, callback){
			if(key == null){
				fs.unlink(filePath +"/."+ file, function(){ callback(true) });
			}else{
				ops.diff.runner(file, function(d, temp, conf){
					if(!deepdiff) deepdiff = require("deep-diff");
					d.forEach(function(v, i, t){ if( (v.path.join(".")) == key){ deepdiff.applyChange(temp,conf,v); } });
					ops.save.runner(file, temp, callback);
				});
			}
		},
		scheduler: function(file, key, callback){
			if(!file) return;
			if(!callback && (typeof(key) == "function")){ callback = key; key = null; }		
			q.schedule({ type: "revert", callback: callback, args: [ file, key ] })
		}
	},
	save: {
		runner: function(file, data, callback){
			fs.writeFile(filePath +"/."+ file, JSON.stringify(data, null, "\t"), function(e){
				if(e) console.log(file +" save error: "+ JSON.stringify(e) +"\n");
				callback(!e);
			});
		}
	},
	load: {
		runner: function(file, temp, callback){
			fs.readFile(filePath +"/"+ (temp?".":"") + file, function(fe, data){
				try { data = JSON.parse(data); } catch(pe){ data = null; } // More error checking?
				callback(data);
			});
		}
	},
	getKey: {
		runner: function(data,key){
			if(key == null) return data;
			if( (typeof(key) != "string") && (key != null) ) key = key.toString();
			var obj = data;
			key = key.split('.');
			var len = key.length;
			for(var i=0; i<(len-1); i++) obj = obj[key[i]];
			return obj[key[len - 1]];
		}
	}
};

	var q = require("./jai.queue.js")(ops);

	return this;
})();
