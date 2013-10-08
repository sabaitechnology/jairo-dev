<div class='pageTitle'>VPN: PPTP</div>
<!-- TODO: pptp_mppe, pptp_stateful
dynamically populate-->

<div class='controlBox'>
	
	<span class='controlBoxTitle clickable'>
		<img id='accordion' src="img/accordion3.png"> $ServerOrName
	</span>
	<input type='button' class='fright' value='Delete' onclick='destroy();'>
	
	<div class='controlBoxContent noclick'>
		<div id='popup'>
			<br>
			<input type='button' value='Connect' name='connect' id='connect' onclick='connect();'>
			<input type='button' value='Disconnect' name='disconnect' id='disconnect' onclick='disconnect();)'>
			<input type='button' value='Edit Info' name='edit_info' id='edit_info'>

		</div>
		<div id='editinfo' class='noshow'>
			<br>
			<input type='button' value='Connect' name='connect' id='connect' onclick='connect();'>
			<input type='button' value='Disconnect' name='disconnect' id='disconnect' onclick='disconnect();)'>
			<table class='controlTable'>
				<tbody>
				 <!--tr><td>Name</td><td><input id='pptp_name' name='pptp_name' /></td></tr -->
				 <tr><td>Server</td><td><input id='pptp_server' name='pptp_server' /></td></tr>
				 <tr><td>Username</td><td><input id='pptp_username' name='pptp_username' /></td></tr>
				 <tr><td>Password</td><td><input id='pptp_password' name='pptp_password' type="password" /></td></tr>
				</tbody>
			</table>
			<br>
			<input type='button' class='fright' value='Save' onclick='save();'>
			<input type='button' class='fright' value='Cancel' id='pptp_cancel' name='pptp_cancel'>
		</div>
	</div>
</div>




<script type='text/ecmascript' src='php/bin.etc.php?q=vpn'></script>
<script type='text/javascript'>

$(document).ready(
	$('.controlBoxTitle').click(function(){
		$(this).children($('#edit_info')).show();
		$(this).show();
		$(this).parent().children('div').toggle();
		$(this).children($('#accordion')).toggleClass('rotate');
	}),
		
	$('#edit_info').click(function(){
		$(this).parent().parent().children($('#editinfo')).show();
		$(this).parent().hide();
	}),

	$('#pptp_cancel').click(function(){
		console.log('clicked Cancel')
		$(this).parent().parent().children($('#popup')).show();
		$(this).parent().hide();
		console.log($(this).parent())
	})

)


$(function(){
$('#pptp_name').val(vpn.pptp.realname);
$('#pptp_server').val(vpn.pptp.server);
$('#pptp_username').val(vpn.pptp.username);
$('#pptp_password').val(vpn.pptp.password);
});

</script>
