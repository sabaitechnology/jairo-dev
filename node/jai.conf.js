var fs 		= require("fs");

module.exports = (function(){
	var me = this;
	var confRoot = "etc";
	var q = [];
	var running = false;
	var current = null;

	this.addOp = function(operation){
		console.log("Running: "+ running);
		q.push(operation);
		me.run();
	}

// set(file, key, value, callback)
// { type: "set", file: file, key: key, callback: callback }
// setConf(file, key, value, callback)


// get(file, key, callback)
// { type: "get", file: file, key: key, callback: callback }
// getConf(file, key, callback)


	this.run = function(){ if(q.length == 0) return;
		if(running) return;
		running = true;
		current = q.shift();
		switch(q.type){
			case "get":
				me.getConf( q. )
			break;
			case "set":
			break;
		}


	}

	// this.next = function(type){
	// 	me.queue[type].running = false;
	// 	me.run(type);
	// }

	this.showQueue = function(){
		console.log("Running: "+ running);
		for(var i=0; i<q.length; i++){
			console.log("Q["+ i +"]: "+ JSON.stringify( q[i] ) );
			console.log("\t"+ typeof( q[i].callback ) );
		}
	}

	this.JSONify = function(data){ return JSON.stringify(data, null, "\t"); }

	this.loadFile = function(file, callback){ if(!file || !callback) return; // TODO: throw an error?
		// We discard the error here because we don't care; we just want a copy of the file.
		// If the file does not exist, we consider an empty file an adequate copy.
		// Perhaps we should also create the file we are attempting to load?
		try{ fs.createReadStream(confRoot +"/"+ file).pipe(fs.createWriteStream(confRoot +"/."+ file)); }catch(e){};
		fs.readFile(confRoot +"/."+ file, function(e, data){
			if(!e){
				try { data = JSON.parse(data); } catch(e){
					console.log(file + " parse error: "+ JSON.stringify(e) +"\n");
					data = null;
				}
				callback(data);
			}else{
				console.log(file +" error: "+ JSON.stringify(e) +"\n");
			}
		});
	}

	this.saveFile = function(file, data, callback){
		fs.writeFile(confRoot +"/."+ file, me.JSONify(data), function(e){
			if(e) console.log(file +" save error: "+ JSON.stringify(e) +"\n");
			callback(!e);
		});
	}

	this.getConf = function(file, key, callback){
		if(!file) return;
		if(!callback){
			if(typeof(key) === 'function'){
				callback = key;
				key = null;
			}else{
				return;
			}
		}
		me.loadFile(file, function(data){
			if(!key){
				if(callback) callback(data);
			}else{
				var obj = data;
				key = key.split('.');
				var len = key.length;
				for(var i=0; i<(len-1); i++){ obj = obj[key[i]]; }	// TODO: while not for?
				if(callback) callback(obj[key[len - 1]]);
			}
		});
	}

	this.setConf = function(file, key, value, callback){
		if(value == null) return;
		if(!key){
			me.saveFile(file,value,callback);
		}else{
			me.getConf(file, function(data){
				if(!data){
					// TODO: Spaceballs, DO SOMETHING! (Probably save value as new file contents.)
					//	Also probably handle creating new keys...
					me.saveFile(file,value,callback);
				}else{
					var obj = data;
					key = key.split('.');
					var len = key.length;
					// TODO: handle case where key doesn't exist.
					for (var i=0; i<(len-1); i++){ obj = obj[key[i]]; }	// TODO: while not for?
					obj[key[len-1]] = value;
					me.saveFile(file,data,callback);
				}
			});
		}
	}

	this.set = function(file, key, value, callback){
		if( !callback && (typeof(value)=="function") ){
			callback = value;
		}else{
			key = [{ key: key, value: value }];
		}
		me.addOp({ type: "set", file: file, key: key, callback: callback });
	}

	this.get = function(file, key, callback){
		me.addOp({ type: "get", file: file, key: key, callback: callback });
	}

// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });
	return this;
})();
