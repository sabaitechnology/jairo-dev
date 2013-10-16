<!-- 
persistent data
-->

<link rel="stylesheet" href="/libs/jquery-ui.min.css" />
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>

<div class='pageTitle'>VPN: Open VPN Server</div>

<br>
<div id="accordion">
	<h3>Tunnel Options</h3>
	<div>
		IE: Mode, Local Host, Remote Host, etc.
	</div>
	<h3>Server Mode</h3>
	<div>
		IE: Netmask, Ifconfig, Push, etc.
	</div>
	<h3>Client Mode</h3>
	<div>
		IE: Client, Pull, Auth-user etc.
	</div>
	<h3>Data Channel Encryption Options</h3>
	<div>
		IE: Secret File, Auth Alg, Keysize, etc.
	</div>
</div>

<script type='text/ecmascript'>

$( document ).ready(function() {
	
	$( "#accordion" ).accordion({ heightStyle: "content", active: "false",
          collapsible: "true" 
  });
});

   


</script>

