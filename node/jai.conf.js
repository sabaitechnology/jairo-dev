var fs 		= require("fs");

module.exports = (function(){
	var me = this;
	var confRoot = "etc";
	var q = [];
	var running = false;
	var current = null;
	var deepdiff = false;
	// this.showQueue = function(){ for(var i=0; i<q.length; i++) console.log("Q["+ i +"]: "+ JSON.stringify( q[i] ) +"\t"+ typeof( q[i].callback ) ); }

	function saveFile(file, data, callback){
		fs.writeFile(confRoot +"/."+ file, JSON.stringify(data, null, "\t"), function(e){
			if(e) console.log(file +" save error: "+ JSON.stringify(e) +"\n");
			callback(!e);
		});
	}

	function loadFile(file, temp, callback){
		fs.readFile(confRoot +"/"+ (temp?".":"") + file, function(e, data){
			if(e || data==""){
				data = {};
			}else{
				try { data = JSON.parse(data); } catch(e){
					// TODO: if data is corrupt we ought probably to save the corrupt contents elsewhere and replace the corrupt file.
					console.log(file + " parse error: "+ JSON.stringify(e) +"\n");
					data = null;
				}
			}
			callback(data);
		});
	}

	var ops = {
		get: function (file, key, callback){
			loadFile(file, true, function(temp){
				loadFile(file, false, function(conf){
					console.log("Temp: "+ JSON.stringify(temp));
					console.log("Conf: "+ JSON.stringify(conf));
				});
			});

			// var confFile = confRoot +"/"+ file;
			// var tempFile = confRoot +"/."+ file;
			// if(!fs.existsSync(tempFile) && fs.existsSync(confFile)) fs.createReadStream(confFile).pipe(fs.createWriteStream(tempFile));
			// fs.readFile(tempFile, function(e, data){
			// 	if(!e){
			// 		if(data==""){
			// 			data = {};
			// 		}else try { data = JSON.parse(data); } catch(e){
			// 			// TODO: if data is corrupt we ought probably to save the corrupt contents elsewhere and replace the corrupt file.
			// 			console.log(file + " parse error: "+ JSON.stringify(e) +"\n");
			// 			data = null;
			// 		}
			// 		if(!key){
			// 			callback(data);
			// 		}else{
			// 			var obj = data;
			// 			key = key.split('.');
			// 			var len = key.length;
			// 			for(var i=0; i<(len-1); i++) obj = obj[key[i]];
			// 			callback(obj[key[len - 1]]);
			// 		}
			// 	}else{
			// 		callback({});
			// 	}
			// });

		},
		set: function (file, key, value, callback){
			if(!key){
				saveFile(file,value,callback);
			}else{
				ops.get(file, null, function(data){
					if(!data) data = {};
					var obj = data;
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
		diff: function(file, callback){
			if(!deepdiff) deepdiff = require("deep-diff");
			ops.get(file, null, function(temp){
				var confFile = confRoot +"/"+ file;
				var conf = (fs.existsSync(confFile) ? JSON.parse(fs.readFileSync(confFile)) : {} );
				callback(deepdiff.diff(conf, temp), conf, temp);
			});
		},
		discard: function(file, callback){

		},
		revert: function(file, key, callback){
			if(!deepdiff) deepdiff = require("deep-diff");

			var confFile = confRoot +"/"+ file;
			var tempFile = confRoot +"/."+ file;
			var conf = (fs.existsSync(confFile) ? JSON.parse(fs.readFileSync(confFile)) : {} );
			var temp = (fs.existsSync(tempFile) ? JSON.parse(fs.readFileSync(tempFile)) : {} );

			deepdiff.observableDiff(temp, conf, function (d){ if(d.path.join(".") == key) deepdiff.applyChange(temp, conf, d); });


			// ops.diff(file, function(d, lhs, rhs){
			// 	d.forEach(function(v, i, t){
			// 		console.log("v:");
			// 		console.log(v);
			// 		var p = v.path.join(".");
			// 		if(p == key){
			// 			// console.log(v);
			// 			console.log(p +" = "+ key);
			// 			// console.log(key);
			// 		}
			// 		// console.log(
			// 		// 	JSON.stringify(v)
			// 		// 	 +" "+ JSON.stringify(i)
			// 		// 	 +" "+ JSON.stringify(t)
			// 		// );
			// 	});
				// for(var i=0; i<d.length; i++){
				// 	if(d[i].path)
				// }
				// console.log(d);
				return;
			// });
		}
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
		ops[current.type].apply(me, current.args);
	}

	this.get = function(file, key, callback){
		if(!file) return;
		if(!callback && (typeof(key) == "function")){ callback = key; key = null; }
		if(!callback) return; // TODO: throw an error?
		q.push({ type: "get", callback: callback, args: [ file, key, next ] });
		run();
	}

	this.set = function(file, key, value, callback){
		if(!file) return;
		if(!key) key = "";
		if(value == null) value = ""; // Test for null, value may legitimately be false.
		q.push({ type: "set", callback: callback, args: [ file, key, value, next ] });
		run();
	}

	this.diff = function(file, callback){
		if(!file || !callback) return;
		q.push({ type: "diff", callback: callback, args: [ file, next ] })
		run();
	}

	this.discard = function(file, callback){
		if(!file) return;
		q.push({ type: "discard", callback: callback, args: [ file ] })
		run();
	}

	this.revert = function(file, key, callback){
		if(!file) return;
		q.push({ type: "revert", callback: callback, args: [ file, key ] })
		run();
	}


// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });
	return this;
})();
