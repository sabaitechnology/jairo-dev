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

	var ops = {
		get: function (file, key, callback){
			var confFile = confRoot +"/"+ file;
			var tempFile = confRoot +"/."+ file;
			if(!fs.existsSync(tempFile) && fs.existsSync(confFile)) fs.createReadStream(confFile).pipe(fs.createWriteStream(tempFile));
			fs.readFile(tempFile, function(e, data){
				if(!e){
					if(data==""){
						data = {};
					}else try { data = JSON.parse(data); } catch(e){
						// TODO: if data is corrupt we ought probably to save the corrupt contents elsewhere and replace the corrupt file.
						console.log(file + " parse error: "+ JSON.stringify(e) +"\n");
						data = null;
					}
					if(!key){
						callback(data);
					}else{
						var obj = data;
						key = key.split('.');
						var len = key.length;
						for(var i=0; i<(len-1); i++) obj = obj[key[i]];
						callback(obj[key[len - 1]]);
					}
				}else{
					callback({});
				}
			});
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
		}
	}

	function next(data){
		running = false;
		current.callback(data);
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

	this.diff = function(file){
		if(!deepdiff) deepdiff = require("deep-diff");
		return ( !fs.existsSync(confRoot+"/."+file) ? [] : deepdiff.diff(
			(fs.existsSync(confRoot+"/"+file) ? JSON.parse(fs.readFileSync(confRoot+"/"+file)) : {} ),
			JSON.parse(fs.readFileSync(confRoot+"/."+file))
		));
	}

// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });
	return this;
})();
