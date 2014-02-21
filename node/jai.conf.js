var fs 		= require("fs");

module.exports = (function(){
	var me = this;
	var confRoot = "etc";
	var q = [];
	var running = false;
	var current = null;
	// this.showQueue = function(){ for(var i=0; i<q.length; i++) console.log("Q["+ i +"]: "+ JSON.stringify( q[i] ) +"\t"+ typeof( q[i].callback ) ); }

	function run(){
		if( (q.length == 0) || running ) return;
		running = true;
		current = q.shift();
		me[current.type].apply(me, current.args);
		// switch(current.type){
		// 	case "get": getConf( current.file, current.key, next ); break;
		// 	case "set": setConf( current.file, current.key, current.value, next ); break;
		// }
	}

	function addOp(operation){
		q.push(operation);
		run();
	}

	function next(data){
		running = false;
		current.callback(data);
		run();
	}

	function saveFile(file, data, callback){
		fs.writeFile(confRoot +"/."+ file, JSON.stringify(data, null, "\t"), function(e){
			if(e) console.log(file +" save error: "+ JSON.stringify(e) +"\n");
			callback(!e);
		});
	}

	function _get(file, key, callback){
		if(!file) return;
		if(!callback && (typeof(key) == "function")){ callback = key; key = null; }
		if(!callback) return; // TODO: throw an error?
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
					for(var i=0; i<(len-1); i++){ obj = obj[key[i]]; }	// TODO: while not for?
					callback(obj[key[len - 1]]);
				}
			}else callback({});
		});
	}

	function _set(file, key, value, callback){
		if(value == null) return;
		if(!key){
			saveFile(file,value,callback);
		}else{
			_get(file, function(data){
				if(!data){
					// TODO: Spaceballs, DO SOMETHING! (Probably save value as new file contents.)
					//	Also probably handle creating new keys...
					saveFile(file,value,callback);
				}else{
					var obj = data;
					key = key.split('.');
					var len = key.length;
					// TODO: handle case where key doesn't exist.
					for (var i=0; i<(len-1); i++){ obj = obj[key[i]]; }	// TODO: while not for?
					obj[key[len-1]] = value;
					saveFile(file,data,callback);
				}
			});
		}
	}

	function etTest(file, key, callback){
		for(var i=0; i<arguments.length; i++){
			console.log(i +": "+ arguments[i]);
		}
	}

	this.set = function(file, key, value, callback){
		addOp({ type: "_set", args: arguments });
	}

	this.get = function(file, key, callback){
		addOp({ type: "_get", args: arguments });
	}

// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });
	return this;
})();
