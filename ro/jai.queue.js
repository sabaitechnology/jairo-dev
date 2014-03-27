
module.exports = (function(ops){

	var me = this;
	var queued = [];
	var running = false;
	var current = null;
	// this.showQueue = function(){ for(var i=0; i<queued.length; i++) console.log("queued["+ i +"]: "+ JSON.stringify( queued[i] ) +"\t"+ typeof( queued[i].callback ) ); }

	function next(){
		var last = null;
		if(current && current.callback && (typeof(current.callback) == "function") ) last = current.callback;
		running = false;
		current = null;
		if(last) last.apply(me,arguments);
		run();
	}

	function run(){
		if( (queued.length == 0) || running ) return;
		running = true;
		current = queued.shift();
		ops[current.type].runner.apply(me, current.args);
	}

	this.schedule = function(op){
		op.args.push(next);
		queued.push(op);
		run();
	}

	for(var op in ops){
		this[op] = ( ops[op].scheduler || ops[op].runner ); // assign scheduler if available
	}

	return this;
});
