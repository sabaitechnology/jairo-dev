<div class='pageTitle'>VPN: PPTP</div>
<!-- TODO: pptp_mppe, pptp_stateful
 list of servers/accnts
 	click to modify -->

<div class='controlBox'><span class='controlBoxTitle'>PPTP</span>
	<div class='controlBoxContent'>
	<div class='controlButtons'>
		<input type='button' value='Start' id='Start' onclick='PPTPsave("start")'>
		<input type='button' value='Stop' onclick='PPTPsave("stop")'>
		<input type='button' value='Save' onclick='PPTPsave("save")'>
		<input type='button' value='Erase' onclick='PPTPsave("erase")'>
		<input type='button' value='Cancel' onclick='javascript:reloadPage();'>
		<br>
	</div>
	<table class='controlTable'>
		<tbody>
		 <!--tr><td>Name</td><td><input id='pptp_name' name='pptp_name' /></td></tr -->
		 <tr><td>Server</td><td><input id='pptp_server' name='pptp_server' /></td></tr>
		 <tr><td>Username</td><td><input id='pptp_username' name='pptp_username' /></td></tr>
		 <tr><td>Password</td><td><input id='pptp_password' name='pptp_password' type="password" /></td></tr>
		</tbody>
	</table>
</div></div>



<script type='text/ecmascript' src='php/bin.etc.php?q=vpn'></script>
<script type='text/javascript'>

$(function(){
$('#pptp_name').val(vpn.pptp.realname);
$('#pptp_server').val(vpn.pptp.server);
$('#pptp_username').val(vpn.pptp.username);
$('#pptp_password').val(vpn.pptp.password);
});

</script>
