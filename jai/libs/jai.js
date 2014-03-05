function parseJson(jsonIn){
	var jsonObj, error=false, txt=[];
	if(jsonIn==null||jsonIn==''){
		jsonObj='';
	}else{
		try {
			jsonObj=JSON.parse(jsonIn);
		}catch(ex){
			error=true;
			txt=[ex,'\tRaw JSON: "'+jsonIn+'"'];
			for(var i in ex){
				txt.push('\t'+ i +': '+ ex[i]);
			}
		}
	}
	return {
		err: error,
		msg: ( error ? txt.join('\n') : jsonObj )
	} /* tragically, there's nothing we can do */
}

function getJson(jsonIn){
	if(jsonIn==''){
		return '';
	};
	jsonObj=parseJson(jsonIn);
	if(jsonObj.err && errors!==false){
		errors.push(jsonObj.msg);
		return '';
	}else{
		return jsonObj.msg;
	}
}

// This function is a simple utility to dump an object as JSON when it has cyclic references (ie, { a: { b: "b", c: a } } ).
function cyclicStringify(obj, delimiter){
	var seen=[];
	return JSON.stringify(obj,function(key, val){
		if(typeof val == "object"){
			if(seen.indexOf(val) >= 0){
				return "(cyclic: @"+key+")";
			}else{
				seen.push(val);
			}
		};
		return val;
	},(delimiter || " "));
}

function what(obj,ownonly,pre){
// if($.isPlainObject(obj)) return 'EMPTY';
 var txt=[];
 if(pre) txt.push('<pre>');
 txt.push(obj);
 for(var i in obj){
 if(ownonly && obj.hasOwnProperty(i)) txt.push(i +': '+ obj[i]); }; 
 if(pre) txt.push('</pre>');
 return txt.join('\n');
}

function help(){ window.open('http://sabaitechnology.zendesk.com/anonymous_requests/new','Submit a Support Request','height=600,width=800,top=50,left=50').focus(); return false; }

/* BEGIN Jai node service */

function jainode(address){
	var me = this;
	this.showTimeout = 500;
	this.address = address;
// We save a pointer to 'this' to remedy caller drift in member functions called by outside objects
//	ie, in functions called externally, the local 'this' will be wrong. Using 'me' here create a closure
//	that is available inside functions defined in this object, like those in this.handle below.
	this.showByNoty = function(msg, extrasettings){ noty($.extend({text: msg },extrasettings)); }
	this.showByAlert = function(msg){ alert(msg); }
	this.sendByHTTP = function(){ me.show("HTTP/Ajax is not yet implemented."); }
	this.sendByAjax = function(){ me.show("Ajax/HTTP is not yet implemented."); }
	this.sendBySocket = function(msg, msgType, callback){
		me.socket.emit( (msgType || "cdata"), msg, callback);
	}
	this.handle = {
		sdata: function(sdata){ me.show( sdata.smsg, { modal: false, timeout: false }); }
		,connect: function(){ me.show("The Jai Node service is connected.",{ timeout: me.showTimeout }); }
		,disconnect: function(){ me.show("The Jai Node service is disconnected.",{ timeout: me.showTimeout }); }
		,reconnect: function(){ me.show("The Jai Node service has reconnected.",{ timeout: me.showTimeout }); }
	};
	// this.request = function(){
  // var socket = io.connect(); // TIP: .connect with no args does auto-discovery
  // socket.on('connect', function () { // TIP: you can avoid listening on `connect` and listen on events directly too!
  //   socket.emit('ferret', 'tobi', function (data) {
  //     console.log(data); // data will be 'woot'
  //   });
  // });
	// };
	this.create = function(){
// TODO: Create notification feed instead of using alert; alert is annoying.
		me.show = ( (typeof(noty) == "undefined") ? me.showByAlert : me.showByNoty );
		if(typeof(io) == "undefined"){
			// use ajax/http
// TODO: define ajax/http methods
			me.send = me.sendByAjax; // me.send = me.sendByHTTP;
		}else{
			me.socket = io.connect(me.address);		// Restore this option with certs { secure: true });
			for(var i in me.handle) me.socket.on(i,me.handle[i]);	// Handlers so easy!
			me.send = me.sendBySocket;
		}
	}
	this.create();
}

/* END Jai node service */

// /* ~ */
