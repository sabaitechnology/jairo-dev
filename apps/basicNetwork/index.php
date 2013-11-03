<!DOCTYPE html><html><head>
<title id='mainTitle'>Sabai Jai Ro</title>
<link rel='stylesheet' type='text/css' href='/libs/jquery-ui.min.css'>
<link rel='stylesheet' type='text/css' href='/libs/jquery.ui.menu.css'>
<link rel='stylesheet' type='text/css' href='css/main.css'>

<script type='text/ecmascript' src='/libs/jquery-1.9.1.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>
<script src="/libs/jquery.mousewheel.js"></script>

<!-- socket.io -->
<script src="http://jainode:31400/socket.io/socket.io.js"></script>

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
	var jn = io.connect('http://jainode:31400'); //, { secure: true });

//	Some examples
//  jn.on('connect_failed', function(){});
//  jn.on('error', function(){});
//	jn.on('reconnect', function(){ noty({ text: "Reconnected to jainode service." }); });
//	jn.on('connect', function(){ noty({ text: "Connected to jainode service." }); });

	// Bind a handler to show information from the server.
	jn.on('sdata', function (sdata) {
	// handle data in sdata.smsg
		noty({ text: sdata.smsg });
	});
}else{
//	We may want a Jainode indicator somewhere on page, though mostly we just want to know when we're connected for our own sakes.
//	IE, do we send the information via jn.emit, or do we perform an ajax call, or do we post it?
//	$(function(){ noty({ text: "Jainode service unavailable." }); });
}

function toServer(msg){ if(!jn){ /* show an error or fallback on ajax/post */ return; }; jn.emit('cdata', { cmsg: msg }); }
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
	$( "#helpSection" ).toggle( 'slide', { direction: 'right' }, 500 );
	return false;
};

$(function(){
	$( "#helpButton" ).click(toggleHelpSection);
});

<?php
 $panel = ( array_key_exists('panel',$_REQUEST) ? preg_replace('/[^a-z\d]/i', '', $_REQUEST['panel']) : null );
 $section = ( array_key_exists('section',$_REQUEST) ? preg_replace('/[^a-z\d]/i', '', $_REQUEST['section']) : null );
 if( empty($panel) ){ $panel = 'network'; $section = 'wan'; }
 $page = "v/$panel". ( empty($section) ? '' : ".$section") .".php";
 if(!file_exists($page)) $page = 'v/lorem.php';
 echo "var panel = '$panel'; var section = '$section';\n";
?>

</script>
</head><body>

<div id='backdrop'>

 <div id='menuContainer'>
	<img id='menuHeader' src='img/menuHeader.png'>
	<ul id='superMenu'>

	 <li>
	<a id='network' class='superMenuLink button'>Network</a>
	<ul id='networkSubMenu' class='subMenu'>
	 <li><a id='network_wan' href='?panel=network&section=wan' class='subMenuLink button'>WAN</a></li>
	 <li><a id='network_lan' href='?panel=network&section=lan' class='subMenuLink button'>LAN</a></li>
	 <li><a id='network_time' href='?panel=network&section=time' class='subMenuLink button'>Time</a></li>
	 <li><a id='network_devicelist' href='?panel=network&section=devicelist' class='subMenuLink button'>Device List</a></li>
	 <li><a id='network_staticips' href='?panel=network&section=staticips' class='subMenuLink button'>Static IPs</a></li>
	</ul>
	 </li>

	 <li>
	<a id='wireless' class='superMenuLink button'>Wireless</a>
	<ul id='wirelessSubMenu' class='subMenu'>
	 <li><a id='wireless_radio' href='?panel=wireless&section=radio' class='subMenuLink button'>Radio</a></li>
	 <li><a id='wireless_survey' href='?panel=wireless&section=survey' class='subMenuLink button'>Survey</a></li>
	 <li><a id='wireless_macfilter' href='?panel=wireless&section=macfilter' class='subMenuLink button'>MAC Filter</a></li>
	</ul>
	 </li>

	 <li>
	<a id='vpn' class='superMenuLink button'>VPN</a>
	<ul id='vpnSubMenu' class='subMenu'>
	 <li><a id='vpn_pptp' href='?panel=vpn&section=pptp' class='subMenuLink button'>PPTP</a></li>
	 <li><a id='vpn_openvpn' href='?panel=vpn&section=openvpn' class='subMenuLink button'>OpenVPN</a></li>
	 <li><a id='vpn_l2tp' href='?panel=vpn&section=l2tp' class='subMenuLink button'>L2TP</a></li>
	 <li><a id='vpn_ipsec' href='?panel=vpn&section=ipsec' class='subMenuLink button'>IPSEC</a></li>
	 <li><a id='vpn_pptpserver' href='?panel=vpn&section=pptpserver' class='subMenuLink button'>PPTP Server</a></li>
	 <li><a id='vpn_openvpnserver' href='?panel=vpn&section=openvpnserver' class='subMenuLink button'>OpenVPN Server</a></li>
	 <li><a id='vpn_gateways' href='?panel=vpn&section=gateways' class='subMenuLink button'>Gateways</a></li>
	</ul>
	 </li>

	 <li>
	<a id='diagnostics' class='superMenuLink button'>Diagnostics</a>
	<ul id='diagnosticsSubMenu' class='subMenu'>
	 <li><a id='diagnostics_ping' href='?panel=diagnostics&section=ping' class='subMenuLink button'>Ping</a></li>
	 <li><a id='diagnostics_trace' href='?panel=diagnostics&section=trace' class='subMenuLink button'>Trace</a></li>
	 <li><a id='diagnostics_nslookup' href='?panel=diagnostics&section=nslookup' class='subMenuLink button'>NS Lookup</a></li>
	 <li><a id='diagnostics_route' href='?panel=diagnostics&section=route' class='subMenuLink button'>Route</a></li>
	 <li><a id='diagnostics_logs' href='?panel=diagnostics&section=logs' class='subMenuLink button'>Logs</a></li>
	</ul>
	 </li>

	 <li>
	<a id='security' class='superMenuLink button'>Security</a>
	<ul id='securitySubMenu' class='subMenu'>
	 <li><a id='security_firewall' href='?panel=security&section=firewall' class='subMenuLink button'>Firewall</a></li>
	 <li><a id='security_portforwarding' href='?panel=security&section=portforwarding' class='subMenuLink button'>Port Forwarding</a></li>
	 <li><a id='security_dmz' href='?panel=security&section=dmz' class='subMenuLink button'>DMZ</a></li>
	 <li><a id='security_conntrack' href='?panel=security&section=conntrack' class='subMenuLink button'>Conntrack</a></li>
	 <li><a id='security_upnp' href='?panel=security&section=upnp' class='subMenuLink button'>UPnP</a></li>
	</ul>
	 </li>

	 <li>
	<a id='about' href='?panel=about' class='superMenuLink button'>About</a>
	 </li>

	 <li>
	<a id='help' href='?panel=help' class='superMenuLink button'>Help</a>
	 </li>


	</ul>
 </div>

 <div id='panelContainer'>

<div id='helpArea'>
	<img id='helpButton' src='img/help.png'>
	<div id='helpSection' class='ui-widget-content ui-corner-al'>
<!-- 		<a href='#' id='closeHelp' class='xsmallText fright'>Close</a> -->
		Display Inline Help
		<input name='inlineHelp' id='inlineHelp' type='checkbox' checked='checked'><br><br>
		<span style='text-decoration: underline'>Links:</span><br>
		<a id='goToHelp' href='#' onclick='doHelp();'>Manual Page</a><br>
		<a id='goToHelp' href='#' onclick='doWiki();'>Wiki Page</a>
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
