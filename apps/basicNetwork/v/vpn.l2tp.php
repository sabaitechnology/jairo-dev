<div class='pageTitle'>VPN: L2TP</div>

<!-- TODO: pptp_mppe, pptp_stateful
 list of servers/accnts
 	click to modify -->

<div class='controlBox'><span class='controlBoxTitle'>L2TP</span>
	<div class='controlBoxContent'>
		<div class='controlButtons'>
			<input type='button' value='Start' id='Start' onclick='PPTPsave("start")'>
			<input type='button' value='Stop' onclick='PPTPsave("stop")'>
			<input type='button' value='Save' onclick='PPTPsave("save")'>
			<input type='button' value='Erase' onclick='PPTPsave("erase")'>
			<input type='button' value='Cancel' onclick='javascript:reloadPage();'>
			<input type='button' value='Help' onclick='window.open("http://www.sabaitechnology.com/v/sabaiHelp/help.html#pptp","_newtab");'><br>
		</div>
		<table class='controlTable'>
			<tbody>
			 <tr><td>Name</td><td><input id='l2tp_name' name='pptp_name' /></td></tr> 
			 <tr><td>Server</td><td><input id='l2tp_server' name='l2tp_server' /></td></tr>
			 <tr><td>Username</td><td><input id='l2tp_username' name='l2tp_username' /></td></tr>
			 <tr><td>Password</td><td><input id='l2tp_password' name='l2tp_password' /></td></tr>
			 <tr><td>Secret Key</td><td><input id='l2tp_secret' name='l2tp_secret' /></td></tr>
			</tbody>
		</table>
		</div>
</div>



<script type='text/ecmascript' src='php/bin.etc.php?q=vpn&l2tp'></script>
<script type='text/ecmascript' src='js/globalize.js'></script>
<script type='text/ecmascript' src='js/time.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

$(function(){
$('#l2tp_name').val(vpn.l2tp.realname);
$('#l2tp_server').val(vpn.l2tp.server);
$('#l2tp_username').val(vpn.l2tp.username);
$('#l2tp_password').val(vpn.l2tp.password);
$('#l2tp_secret').val(vpn.l2tp.psk);
});

</script>