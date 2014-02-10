function jaiqueue(){
	var me = this;
	var queue = {};

	this.add = function(type, callback){
		if(!me.queue[type]) me.queue[type] = { running: false, q: [] };
		me.queue[type].q.push(callback);
		me.run(type);
	}

	this.run = function(type){
		if(!me.queue[type]) return;
		if(!me.queue[type].running){
			me.queue[type].running = me.queue[type].q.shift();
			if(typeof(me.queue[type].running) !== 'function'){
				me.queue[type].running = false;
				me.run(type);
			}
			me.queue[type].running(function(){ me.next(type); });
		}
	}

	this.next = function(type){
		me.queue[type].running = false;
		me.run(type);
	}
}


module.exports = new jaiqueue();