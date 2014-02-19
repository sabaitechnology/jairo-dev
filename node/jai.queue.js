function jaiqueue(){
	var me = this;
	var queue = [];

	this.add = function(type, callback){
		if(!me.queue[type]) me.queue[type] = { running: false, q: [] };
		me.queue[type].q.push(callback);
		me.run(type);
	}

	this.run = function(type){
		if( !me.queue[type] || me.queue[type].running || (me.queue[type].q.length < 1) ) return;
		me.queue[type].running = true;
		if(typeof(me.queue[type].q[0]) !== 'function'){
			me.queue[type].running = false;
			me.queue[type].q.shift();
			me.run(type);
		}else{
			me.queue[type].q[0](function(){ me.next(type); });
		}
	}

	this.next = function(type){
		me.queue[type].running = false;
		me.run(type);
	}
}


module.exports = new jaiqueue();
