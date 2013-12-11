<!DOCTYPE html><html><head>
<title id='mainTitle'>Sabai Jai Ro</title>
<link rel='stylesheet' type='text/css' href='/libs/jquery-ui.min.css'>
<link rel='stylesheet' type='text/css' href='/libs/jquery.ui.menu.css'>
<link rel='stylesheet' type='text/css' href='css/main.css'>

<script type='text/ecmascript' src='/libs/jquery-1.9.1.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>
<script src="/libs/jquery.mousewheel.js"></script>

<!-- socket.io
	We're making PHP give us a valid address for our server since this address will actually refer to the machine we're running on, which is different everywhere.
-->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>:31400/socket.io/socket.io.js"></script>

<!-- noty stuff  -->
<script type="text/javascript" src="/libs/jquery.noty.js"></script>
<script type="text/javascript" src="/libs/top.js"></script>
<script type="text/javascript" src="/libs/bottomRight.js"></script>
<script type="text/javascript" src="/libs/default.js"></script>

<!-- script type='text/ecmascript' src='/libs/jai.js'></script -->
<script type='text/ecmascript' src='js/math.js'></script>
<script type='text/ecmascript' src='js/widgets.js'></script>
<script type='text/ecmascript' src='js/main.js'></script>
<script type='text/ecmascript'>

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
	alert('We have no nodes!');
//	We may want a Jainode indicator somewhere on page, though mostly we just want to know when we're connected for our own sakes.
//	IE, do we send the information via jn.emit, or do we perform an ajax call, or do we post it?
//	$(function(){ noty({ text: "Jainode service unavailable." }); });
}

function toServer(msg, pg){ 
	if(!jn){ 
		/* show an error or fallback on ajax/post */ 
		return; 
	}; jn.emit('cdata', 
		{ cmsg: msg, cpg: pg }); 
}
/* END Jai node service */

//noty settings 
$.noty.defaults = {
	layout: 'bottomRight',
	theme: 'defaultTheme',
	type: 'alert',
	text: '',
	dismissQueue: true, // If you want to use queue feature set this true
	template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
	animation: {
		open: {height: 'toggle'},
		close: {height: 'toggle'},
		easing: 'swing',
		speed: 500 // opening & closing animation speed
	},
	timeout: 1000, // delay for closing event. Set false for sticky notifications
	force: false, // adds notification to the beginning of queue when set to true
	modal: false,
	maxVisible: 5, // you can set max visible notification for dismissQueue true option
	closeWith: ['click'], // ['click', 'button', 'hover']
	callback: {
		onShow: function() {},
		afterShow: function() {},
		onClose: function() {},
		afterClose: function() {}
	},
	buttons: false // an array of buttons
};

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
