// this is how to update a config file

//1. require these modules:

//performs console tasks
var sys = require('sys')
//Runs a command in a shell and buffers the output.
var exec = require('child_process').exec;
//returns a formatted string
var util = require('util');

//2. define a generic sed function

//takes a file path, substitution arguments, overwrite setting, sudo setting, and callback
function sed(file, args, destructive, needsSudo, callback){
	//need to print something like: sed -i 's/day/night/' old new 
	var cmd = (needsSudo?"sudo":"")+ "sed "+(destructive?"-i ":"")+ args.join("") +" "+file;
	//execute the cmd
	exec(cmd, function (error, stdout, stderr){
		//define result as object
		var result = {};
		//if you get an error
	  if (error !== null){
	  	//set a made up sabai property to false
	  	result.sabai = false;
	  	result.error = error;
	  	result.stderr = stderr;
	  	result.cmd = cmd;
	  //if you don' get an error
	  }else{
	  	result.sabai = true;
	  	//if not set to destructive, send the error contents to standard out
	  	if(!destructive) result.content = stdout;
	  }
	  //make result the callback 
	  callback(result);
	});
}


//3. Call sed function 
// var ip				="222.111.222.111";
// var ipaddress	= ip.replace(".", "\.", "gi");
// var ipregex		="[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}";

// sed("./test.conf", ["-r ","s/range.*" + ipregex + "/'range '" + ipaddress + "/g"], false, false, function(result){

// 	// if no error, console log the result contents 
// 	if(result.sabai){
// 		console.log(result.content);
// 	}else{
// 		//Return a string representation of error results
// 		console.log("\tError:\n"+ util.inspect(result));
// 	}
// });