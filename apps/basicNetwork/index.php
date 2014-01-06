<!DOCTYPE html><html><head>
<title id='mainTitle'>Sabai Jai Ro</title>

<link rel='stylesheet' type='text/css' href='/libs/jqueryui.css'>
<link rel='stylesheet' type='text/css' href='css/main.css'>

<script type="text/javascript" src="/libs.php"></script>

<script type='text/ecmascript' src='js/main.js'></script>

<!-- socket.io
	We're making PHP give us a valid address for our server since this address will actually refer
	 to the machine we're running on, which is different everywhere.
-->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>:31400/socket.io/socket.io.js"></script>

<script type='text/ecmascript'>
// noty settings -- moved to /libs/jquery.noty.jai.js

/* BEGIN Jai node service */
if(typeof(io) != 'undefined'){
	var jn = io.connect('http://<?php echo $_SERVER['HTTP_HOST']; ?>:31400'); //, { secure: true });
//	Some examples
//  jn.on('connect_failed', function(){});
//  jn.on('error', function(){});
//	jn.on('reconnect', function(){ noty({ text: "Reconnected to jainode service." }); });
//	jn.on('connect', function(){ noty({ text: "Connected to jainode service." }); });

	// Bind a handler to show information from the server (server sends sdata)
	jn.on('sdata', function (sdata) {
	// handle data in sdata.smsg
		noty({ text: sdata.smsg });
	});
}else{
//	We may want a Jainode indicator somewhere on page, though mostly devs want to know when we're connected.
//	IE, do we send the information via jn.emit, or do we perform an ajax call, or do we post it?
//	$(function(){ noty({ text: "Jainode service unavailable." }); });
}

// Simple notification so we know we're connected or not.
$(function(){
	noty({ text: ( jn ? "We have nodes!" : "We are nodeless!" ) });
})

/*
 Depending on whether the node service is available or not, we will want to define the toServer
function differently; ie, if we can't send with sockets, can we sent via ajax? If not, can we send via post?
*/

function toServer(msg, msgType){ 
	if(!jn){ 
		/* show an error or fallback on ajax/post */ 
		return; 
	};
	if(typeof(msg)!='string') msg = JSON.stringify(msg);
	jn.emit('cdata',{ cmsg: msg, cmsgType: msgType }); 
}
/* END Jai node service */

function toggleHelpSection() {
	$( "#helpClose").show();
	$( "#helpSection" ).toggle( 'slide', { direction: 'right' }, 500 );
	$( "#helpButton" ).hide();
	return false;
};

function closeHelpSection() {
	$( "#helpClose").hide();
	$( "#helpSection" ).toggle( 'slide', { direction: 'right' }, 500 );
	$( "#helpButton" ).show();
	return false;
}

<?php
 $template = array_key_exists('t',$_REQUEST);
 $panel = ( array_key_exists('panel',$_REQUEST) ? preg_replace('/[^a-z\d]/i', '', $_REQUEST['panel']) : null );
 $section = ( array_key_exists('section',$_REQUEST) ? preg_replace('/[^a-z\d]/i', '', $_REQUEST['section']) : null );
 if( empty($panel) ){ $panel = 'network'; $section = 'wan'; }
 $page = ( $template ?'m':'v') ."/$panel". ( empty($section) ? '' : ".$section") .".php";
 if(!file_exists($page)) $page = 'v/lorem.php';
 echo "var template = ". ($template?'true':'false') ."; var panel = '$panel'; var section = '$section';\n";
?>

$(function(){
	$('#goToHelp').attr('href', 'http://wiki.jairoproject.com' + location.search);
	$('#goToWiki').attr('href', 'help.php' + location.search);
	$( "#helpButton" ).click(toggleHelpSection);
	$( '#helpClose').click(closeHelpSection)
});

</script>
</head><body>

<div id='backdrop'>
	<?php include('menu.php'); ?>

	<div id='panelContainer'>

		<div id='helpArea'>
			<img id='helpButton' src='img/help.png'>
			<div id='helpSection' class='ui-widget-content ui-corner-al'>
		<!-- 		<a href='#' id='closeHelp' class='xsmallText fright'>Close</a> -->
				Display Inline Help
				<a id='helpClose' class='noshow xsmallText' href='#'>Close</a>
				<input name='inlineHelp' id='inlineHelp' type='checkbox' checked='checked'><br><br>
				<span style='text-decoration: underline'>Links:</span><br>
				<a id='goToHelp' href='#'>Help Page</a><br>
				<a id='goToWiki' href='#'>Wiki Page</a>
			</div>
		</div>

		<div id='panel'>
			<form id='fe'>
			<?php include($page); ?>
			</form>
		</div>
	</div>
</div>

</body></html>
