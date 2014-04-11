
(function (exports, global) {

	var ro = exports;

// Construction;

	ro.version = "0.0.1";

	if(console) console.log("Ro v"+ ro.version +".");


	if ('object' === typeof module){
		console.log("We have a module object.");
	}else{
		console.log("No module.");
	}
	if('function' === typeof require){
		console.log("We have a require function.");
	}else{
		console.log("Can't require.");
	}



})('object' === typeof module ? module.exports : (this.ro = {}), this);

