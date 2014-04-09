
module.exports = (function(){
	var me = this;

	this.isEmptyObject = function(obj){
		// null and undefined are "empty"
		if (obj == null) return true;

		// Assume if it has a length property with a non-zero value that that property is correct.
		if (obj.length && obj.length > 0) return false;
		if (obj.length === 0) return true;

		// Otherwise, does it have any properties of its own? // Note that this doesn't handle toString and toValue enumeration bugs in IE < 9
		for(var key in obj) if(hasOwnProperty.call(obj, key)) return false;

		return true;
	}

	this.cyclicStringify = function(obj, delimiter){
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

	// extend borrowed from jQuery v1.10.2 (at the moment, the current version in use in Jai)

	this.extend = function() {
		var src, copyIsArray, copy, name, options, clone,
			target = arguments[0] || {},
			i = 1,
			length = arguments.length,
			deep = false;

		// Handle a deep copy situation
		if ( typeof target === "boolean" ) {
			deep = target;
			target = arguments[1] || {};
			// skip the boolean and the target
			i = 2;
		}

		// Handle case when target is a string or something (possible in deep copy)
		if ( typeof target !== "object" && !jQuery.isFunction(target) ) {
			target = {};
		}

		// extend jQuery itself if only one argument is passed
		if ( length === i ) {
			target = this;
			--i;
		}

		for ( ; i < length; i++ ) {
			// Only deal with non-null/undefined values
			if ( (options = arguments[ i ]) != null ) {
				// Extend the base object
				for ( name in options ) {
					src = target[ name ];
					copy = options[ name ];

					// Prevent never-ending loop
					if ( target === copy ) {
						continue;
					}

					// Recurse if we're merging plain objects or arrays
					if ( deep && copy && ( jQuery.isPlainObject(copy) || (copyIsArray = jQuery.isArray(copy)) ) ) {
						if ( copyIsArray ) {
							copyIsArray = false;
							clone = src && jQuery.isArray(src) ? src : [];

						} else {
							clone = src && jQuery.isPlainObject(src) ? src : {};
						}

						// Never move original objects, clone them
						target[ name ] = jQuery.extend( deep, clone, copy );

					// Don't bring in undefined values
					} else if ( copy !== undefined ) {
						target[ name ] = copy;
					}
				}
			}
		}

		// Return the modified object
		return target;
	};

	this.accumulateHTTPArguments = function(body, actionURL){
		if(body.length>0){
			try {
				body = JSON.parse(body);
			}catch(e){
				console.error("JSON parse error on data:\n"+ body);
				body = {};
			}
		}else{ body = {}; }

		if( (typeof(actionURL) == "string") && ( (n = actionURL.indexOf("?")) != -1 ) ){
			try {
				actionURL = require("querystring").parse(actionURL.substr(n + 1));
			}catch(e){
				actionURL = {};
			}
		}else{
			actionURL = {};
		}

		console.log(body);
		console.log(actionURL);

		return me.extend(body,actionURL);
	}

	this.error = function(s,msg){
		s ?
			s.emit("sdata", { smsg: "Error: "+ msg })
				:
			console.error("Error: "+ msg);
	}

	return this;
})();
