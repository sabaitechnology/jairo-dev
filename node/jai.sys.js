var fs 		= require("fs");
// var util	= require("util");

var ops = {
	get: {
		action: function (file, key, callback){
			loadFile(file, true, function(temp){
				if(!temp){
					loadFile(file, false, function(conf){
						if(!conf) conf = {};
						callback(getKey(conf,key));
					});
				}else{
					callback(getKey(temp,key));
				}
			});
		},
		schedule: function(file, key, callback){
			if(!file) return;
			if(!callback && (typeof(key) == "function")){ callback = key; key = null; }
			if(!callback) return; // TODO: throw an error?
			q.push({ type: "get", callback: callback, args: [ file, key, next ] });
			run();
		}
	},
	set: {
		action: function (file, key, value, callback){
			if(key == null){
				saveFile(file,value,callback);
			}else{
				ops.get.action(file, null, function(data){
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
						saveFile(file,data,callback);
					}
				});
			}
		},
		schedule: function(file, key, value, callback){
			if(!file) return;
			if(!callback && (typeof(value) == "function")){ callback = value; value = key; key = null; }
			if(key == null) key = "";
			if(value == null) value = ""; // Test for null, value may legitimately be false.
			q.push({ type: "set", callback: callback, args: [ file, key, value, next ] });
			run();
		}
	},
	diff: {
		action: function(file, callback){
			loadFile(file, true, function(temp){
				loadFile(file, false, function(conf){
					if(!conf) conf = {};
					if(!temp) temp = conf;
					if(!deepdiff) deepdiff = require("deep-diff");
					callback((deepdiff.diff(temp,conf) || []),temp,conf);
				});
			});
		},
		schedule: function(file, callback){
			if(!file || !callback) return;
			q.push({ type: "diff", callback: callback, args: [ file, next ] })
			run();
		}
	},
	revert: {
		action: function(file, key, callback){
			if(key == null){
				fs.unlink(filePath +"/."+ file, function(){ callback(true) });
			}else{
				ops.diff.action(file, function(d, temp, conf){
					if(!deepdiff) deepdiff = require("deep-diff");
					d.forEach(function(v, i, t){ if( (v.path.join(".")) == key){ deepdiff.applyChange(temp,conf,v); } });
					saveFile(file, temp, callback);
				});
			}
		},
		schedule: function(file, key, callback){
			if(!file) return;
			if(!callback && (typeof(key) == "function")){ callback = key; key = null; }		
			q.push({ type: "revert", callback: callback, args: [ file, key, next ] })
			run();
		}
	}
}

module.exports = (function(){
	var me = this;
	var filePath = "conf/etc";
	var q = [];
	var running = false;
	var current = null;
	var deepdiff = false;
	// this.showQueue = function(){ for(var i=0; i<q.length; i++) console.log("Q["+ i +"]: "+ JSON.stringify( q[i] ) +"\t"+ typeof( q[i].callback ) ); }
	// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });

	function saveFile(file, data, callback){
		fs.writeFile(filePath +"/."+ file, JSON.stringify(data, null, "\t"), function(e){
			if(e) console.log(file +" save error: "+ JSON.stringify(e) +"\n");
			callback(!e);
		});
	}

	function loadFile(file, temp, callback){
		fs.readFile(filePath +"/"+ (temp?".":"") + file, function(fe, data){
			try { data = JSON.parse(data); } catch(pe){ data = null; } // More error checking?
			callback(data);
		});
	}

	function getKey(data,key){
		if(key == null) return data;
		if( (typeof(key) != "string") && (key != null) ) key = key.toString();
		var obj = data;
		key = key.split('.');
		var len = key.length;
		for(var i=0; i<(len-1); i++) obj = obj[key[i]];
		return obj[key[len - 1]];
	}

	function next(){
		running = false;
		current.callback.apply(me,arguments);
		current = null;
		run();
	}

	function run(){
		if( (q.length == 0) || running ) return;
		running = true;
		current = q.shift();
		ops[current.type].action.apply(me, current.args);
	}

	for(var op in ops){
		this[op] = ops[op].schedule;
	}

	return this;
})();
