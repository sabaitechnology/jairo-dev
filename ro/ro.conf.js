var fs 		= require("fs");
var roqueue	= require("./ro.queue.js");
// var util	= require("util");

module.exports = (function(){
	var
		me = this
		,filePath = "conf/etc"
		,deepdiff = false
		// ,fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); })
	;

roqueue.call(this,{
	get: {
		runner: function (file, key, callback){
			me.now.load(file, true, function(temp){
				if(!temp){
					me.now.load(file, false, function(conf){
						if(!conf) conf = {};
						callback(me.now.getKey(conf,key));
					});
				}else{
					callback(me.now.getKey(temp,key));
				}
			});
		}
		,scheduler: function(file, key, value, callback){
			if(!file) return;
			if(!callback){
				if(typeof(value) == "function"){
					callback = value; value = null;
				}else if(typeof(key) == "function"){
					callback = key; key = null;
				}else{
					console.error("No callback for get so no action performed.");
					return; // TODO: throw an error?
					// Set doesn't need a callback because it has effects, but if get has no callback,
					// then it is basically a no-op: get data and do nothing with it.
				}
			}
			schedule({ type: "get", callback: callback, args: [ file, key ] });
		}
	}
	,set: {
		runner: function (file, key, value, callback){
			if(key == null){
				me.now.save(file,value,callback);
			}else{
				me.now.get(file, null, function(data){
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
						me.now.save(file,data,callback);
					}
				});
			}
		}
		,scheduler: function(file, key, value, callback){
			if(!file) return;
			if(!callback && (typeof(value) == "function")){ callback = value; value = key; key = null; }
			if(key == null) key = "";
			if(value == null) value = ""; // Test for null, value may legitimately be false.
			schedule({ type: "set", callback: callback, args: [ file, key, value ] });
		}
	}
	,diff: {
		runner: function(file, callback){
			me.now.load(file, true, function(temp){
				me.now.load(file, false, function(conf){
					if(!conf) conf = {};
					if(!temp) temp = conf;
					if(!deepdiff) deepdiff = require("deep-diff");
					callback((deepdiff.diff(temp,conf) || []),temp,conf);
				});
			});
		}
		,scheduler: function(file, callback){
			if(!file || !callback) return;
			schedule({ type: "diff", callback: callback, args: [ file ] })
		}
	}
	,revert: {
		runner: function(file, key, callback){
			if(key == null){
				fs.unlink(filePath +"/."+ file, function(){ callback(true) });
			}else{
				me.now.diff(file, function(d, temp, conf){
					if(!deepdiff) deepdiff = require("deep-diff");
					d.forEach(function(v, i, t){ if( (v.path.join(".")) == key){ deepdiff.applyChange(temp,conf,v); } });
					me.now.save(file, temp, callback);
				});
			}
		}
		,scheduler: function(file, key, callback){
			if(!file) return;
			if(!callback && (typeof(key) == "function")){ callback = key; key = null; }		
			schedule({ type: "revert", callback: callback, args: [ file, key ] })
		}
	}
	,save: {
		runner: function(file, data, callback){
			fs.writeFile(filePath +"/."+ file, JSON.stringify(data, null, "\t"), function(e){
				if(e) console.log(file +" save error: "+ JSON.stringify(e) +"\n");
				callback(!e);
			});
		}
	}
	,load: {
		runner: function(file, temp, callback){
			fs.readFile(filePath +"/"+ (temp?".":"") + file, function(fe, data){
				try { data = JSON.parse(data); } catch(pe){ data = null; } // More error checking?
				callback(data);
			});
		}
	}
	,getKey: {
		runner: function(data,key){
			if(key == null || key =="") return data;
			if( (typeof(key) != "string") && (key != null) ) key = key.toString();
			var obj = data;
			key = key.split('.');
			var len = key.length;
			if(len==1 && key[0] == "") return data;
			for(var i=0; i<(len-1); i++) obj = obj[key[i]];
			return obj[key[len - 1]];
		}
	}
});

	return this;
})();
