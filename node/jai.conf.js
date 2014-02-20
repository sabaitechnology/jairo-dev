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

	this.run = function(){ if(q.length == 0) return;
		if(running) return;
		running = true;
		current = q.shift();
		switch(current.type){
			case "get": me.getConf( current.file, current.key, me.next(current.callback) ); break;
			case "set": me.setConf( current.file, current.key, current.value, me.next(current.callback) ); break;
		}
	}

	this.next = function(callback){
		return function(){
			running = false;
			callback();
			me.run();
		}
	}

	this.showQueue = function(){
		console.log("Running: "+ running);
		for(var i=0; i<q.length; i++){
			console.log("Q["+ i +"]: "+ JSON.stringify( q[i] ) );
			console.log("\t"+ typeof( q[i].callback ) );
		}
	}

	this.loadFile = function(file, callback){ if(!file || !callback) return; // TODO: throw an error?
		if(!fs.exists(confRoot +"/."+ file)){
			if(fs.exists(confRoot +"/"+ file)){
				fs.createReadStream(confRoot +"/"+ file).pipe(fs.createWriteStream(confRoot +"/."+ file));
			}else{
				callback();
			}
		}

		// fs.readFile(confRoot +"/."+ file, function(e, data){
		// 	console.log("11?");
		// 	return;
		// 	// console.log(file + " contents: "+ JSON.stringify(data) +"\n");
		// 	if(!e){
		// 		try { data = JSON.parse(data); } catch(e){
		// 			console.log(file + " parse error: "+ JSON.stringify(e) +"\n");
		// 			data = null;
		// 		}
		// 		callback(data);
		// 	}else{
		// 		console.log(file +" error: "+ JSON.stringify(e) +"\n");
		// 	}
		// });

	}

	this.saveFile = function(file, data, callback){
		fs.writeFile(confRoot +"/."+ file, JSON.stringify(data, null, "\t"), function(e){
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
		me.addOp({ type: "set", file: file, key: key, value: value, callback: callback });
	}

	this.get = function(file, key, callback){
		me.addOp({ type: "get", file: file, key: key, callback: callback });
	}

// var fw = fs.watch('etc', function (event, filename){ console.log("Filename:"+ filename +"\nEvent:\n" + JSON.stringify(event)); });
	return this;
})();
