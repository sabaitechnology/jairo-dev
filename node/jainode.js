/*
	TODO:
		Add firewall rule to block jainode service through wan port (unless enabled)
		Restrict origins if possible
*/

var fs 		= require('fs');
var util 	= require('util');
var io 		= require('socket.io').listen(31400, {
		"log level": 1,
		"origins": "*:80"
});

function error(socket, msg) {
	if(socket) {
		socket.emit('sdata', {
			smsg: 'Error: '+ msg +'.'
		});
	}else {
		// console.log(msg);
	}
}

function loadConfig(){
	var etc = false;
	try {
			etc = JSON.parse(fs.readFileSync("../apps/basicNetwork/etc.js"))
	}
	catch(e) {
			console.log(util.inspect(e, { depth: null }))
			// throw(e); // Throwing this crashes our node.js instance.
	}
	return etc;
}

function update(socket, cdata) {
	// Load config, report errors
	var etc = loadConfig();
	if (etc==false) {
		error(socket, "Config file failed to load.")
		return;
	}

	// PART 1: Parse data from client into array of "property.value"  
	var stuffIsaved = [];
	var stuffIgot = [];
	var lookUp = [];
	// Turn cmsg into JSON object
	var msgContent = JSON.parse(cdata.cmsg);
	console.log(cdata.cmsg)
	console.log(msgContent)
	// console.log(etc.lan.mask)
	// console.log(msgContent['wan_mask'])
	// console.log(etc['lan']['mask'])

	// Turn each section_prop => section.prop so we can drill into etc.js json object
	for (var i in msgContent) {
		stuffIgot.push(i)
		stuffIsaved.push( i.replace("_",".") )
		// console.log(stuffIgot)
	}


	// Let client know if nothing was saved - ADAPT THIS TO FOR SPLIT
	if (stuffIsaved.length < 1) {
		socket.emit('sdata', {
			smsg: 'Nothing to save.'
		});
		return;
	} 

	//PART 2: Loop through array and update etc object properties
	for (i=0; i<stuffIgot.length; i++) {
		var section_prop = stuffIgot[i].split("_")
		etc[section_prop[0]][section_prop[1]]=msgContent[stuffIgot[i]]
		// console.log(section + " = " +msgContent[stuffIgot[i]])	
	}

	return etc;
	

}


 //  ____                    _____ _         
 // / ___|  __ ___   _____  | ____| |_ ___   
 // \___ \ / _` \ \ / / _ \ |  _| | __/ __|  
 //  ___) | (_| |\ V /  __/ | |___| || (__ _ 
 // |____/ \__,_| \_/ \___| |_____|\__\___(_)
                                          
	// Save config to file (this should call update() and use {fs.writefileSync}
function save(socket, cdata) {
	var updates = update(socket, cdata);

	//write new file using updated content - 2 means pretty print 
  fs.writeFile('etccopy.js', JSON.stringify(updates, null, 2), function (error, stdout, stderr){
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
	  }
		socket.emit('sdata', { smsg: 'What happen: "'+ (result.sabai?'Good':'Bad') +'".'});

	// Call/queue config section callbacks (this updates config files)

	// let client know we're done
	socket.emit('sdata', {
		// smsg: 'Saved configuration messages for "'+ stuffIsaved.join(',') +'".'
		smsg: 'Saved configuration messages.'
	});

	});
}

io.sockets.on('connection', function(socket){
	// socket.emit('sdata', { smsg: 'Connected.' });

	socket.on('cdata', function(cdata){

//		socket.emit('sdata', { smsg: 'R: "'+ cdata.cmsg +'".'});
//		console.log(JSON.stringify(JSON.parse(cdata.cmsg), null, 2));

		socket.emit('sdata', { smsg: 'R.' });
//		console.log(JSON.stringify(JSON.parse(cdata), null, 2));
		console.log(cdata.cmsg);
		console.log(cdata.cmsg.type);

	});
//	socket.on('save', function(savedata){}

});
