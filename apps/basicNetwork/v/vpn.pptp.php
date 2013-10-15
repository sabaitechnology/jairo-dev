<div class='pageTitle'>VPN: PPTP</div>
<!-- TODO: pptp_mppe, pptp_stateful
 persistant data-->
<div id='container'>

	</div>

	<!-- BEGIN ADD NEW -->

	<input type='button' id='add_pptp' value='Add New' onClick='addNew();'>
	<div id='addNew' class='controlBoxContent noshow'>
				<br>
				<table class='controlTable'>
					<thead><th>Add New PPTP</th>
					</thead>
					<tbody>
					 <tr><td>Name</td><td><input id='add_name' name='pptp_name' /></td></tr 
					 <tr><td>Server</td><td><input id='add_server' name='add_server' /></td></tr>
					 <tr><td>Username</td><td><input id='add_username' name='add_username' /></td></tr>
					 <tr><td>Password</td><td><input id='add_password' name='add_password' type="password" /></td></tr>
					</tbody>
				</table>
				<br>
				<input type='checkbox' class='connect' checked='checked' name='connect'> Connect Now?</input>
				<br>
				<input type='button' class='fright' id='save_Add' value='Save' onclick='saveAdd();' />
				<input type='button' class='fright' id='cancel_Add' value='Cancel' onClick='cancelAdd();' />
	</div>

</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=vpn'></script>
<script type='text/javascript'>

$.ajax("php/bin.network.pptp.php", {
	type: 'post',
	dataType: "json",
	data: $("#fe").serialize(),
	success: function(o){
		for(i=0; i<o.pptp.length; i++){

			if(o.pptp[i].name.length == 0){

				$('#container').append("<div class='controlBox'><span class='controlBoxTitle clickable'><img class='accordionarrow' src='img/accordion3.png'> " + o.pptp[i].server + "</span><a href='#' class='fright delete'><img src='img/delete.gif'></a><div class='controlBoxContent accordion'><div class='popup'><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Edit Info' name='edit_info' class='edit_info'><br><br>	</div><div class='editinfo noshow'><br><input type='button' value='Connect' name='connect' class='connect'><input type='button' value='Disconnect' name='disconnect' class='disconnect'><br><br><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value=''/></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+ o.pptp[i].server + "></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+o.pptp[i].user+" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+o.pptp[i].password+" ></td></tr></tbody></table><br><input type='button' class='fright pptp_save' value='Save'><input type='button' class='fright pptp_cancel' value='Cancel'></div></div>")
			}else{

				$('#container').append("<div class='controlBox'><span class='controlBoxTitle clickable'><img class='accordionarrow' src='img/accordion3.png'> " + o.pptp[i].name + "</span><a href='#' class='fright delete'><img src='img/delete.gif'></a><div class='controlBoxContent accordion'><div class='popup'><br><input type='button' value='Connect' name='connect' class='connect'><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Edit Info' name='edit_info' class='edit_info'><br><br>	</div><div class='editinfo noshow'><br><br><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + o.pptp[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+o.pptp[i].server +"></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+o.pptp[i].user +" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+o.pptp[i].password +" ></td></tr></tbody></table><br><input type='button' class='fright pptp_save' value='Save'><input type='button' class='fright pptp_cancel' value='Cancel'></div></div>")
			}
		}

		}
	})
function addNew() {
	$('#add_pptp').hide();
	$('#addNew').show();
}

function cancelAdd() {
	$('#add_name').val('');
	$('#add_server').val('');
	$('#add_username').val('');
	$('#add_password').val('');
	$('#addNew').hide();
	$('#add_pptp').show();
}

function saveAdd() {
	if($('#add_name').length == 0){

				$('#container').append("<div class='controlBox'><span class='controlBoxTitle clickable'><img class='accordionarrow' src='img/accordion3.png'> " + $('#add_server').val() + "</span><a href='#' class='fright delete'><img src='img/delete.gif'></a><div class='controlBoxContent accordion'><div class='popup'><br><input type='button' value='Connect' name='connect' class='connect'><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Edit Info' name='edit_info' class='edit_info'><br><br>	</div><div class='editinfo noshow'><br><input type='button' value='Connect' name='connect' class='connect'><input type='button' value='Disconnect' name='disconnect' class='disconnect'><br><br><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value=''/></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+ $('#add_server').val() + "></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+ $('#add_username').val() +" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+ $('#add_password').val() +" ></td></tr></tbody></table><br><input type='button' class='fright pptp_save' value='Save'><input type='button' class='fright pptp_cancel' value='Cancel'></div></div>")
			}else{

				$('#container').append("<div class='controlBox'><span class='controlBoxTitle clickable'><img class='accordionarrow' src='img/accordion3.png'> " + $('#add_name').val() + "</span><a href='#' class='fright delete'><img src='img/delete.gif'></a><div class='controlBoxContent accordion'><div class='popup'><br><input type='button' value='Connect' name='connect' class='connect'><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Edit Info' name='edit_info' class='edit_info'><br><br>	</div><div class='editinfo noshow'><br><br><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + $('#add_name').val() + "'></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value=" + $('#add_server').val() + "></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+ $('#add_username').val() + " ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value=" + $('#add_password').val() + " ></td></tr></tbody></table><br><input type='button' class='fright pptp_save' value='Save'><input type='button' class='fright pptp_cancel' value='Cancel'></div></div>")
			}

	cancelAdd()
}

$('#container').on('click','.pptp_save',function(){
	$(this).parent().parent().children($('.popup')).show();
	$(this).parent().hide();
})

$('#container').on('click','.controlBoxTitle',function(){
	$(this).children($('.edit_info')).show();
	$(this).show();
	$(this).parent().children('div').toggle();
	$(this).children($('.accordionarrow')).toggleClass('rotate');
})

$('#container').on('click', '.edit_info', function(){	
	$(this).parent().parent().children($('.editinfo')).show();
	$(this).parent().hide();
})

$('#container').on('click', '.pptp_cancel', function(){
		$(this).parent().parent().children($('.popup')).show();
		$(this).parent().hide();
})

$('#container').on('click','.delete', function(){
		alert('Are you sure you want to delete?')
		$(this).parent().remove();
})

$('#container').on('click',":input[name^='connect']", function(){

		$(":input[class^='connect']").attr('disabled', false);
		$(":input[class^='disconnect']").attr('disabled', true);
		$(this).next(":input[class^='disconnect']").attr('disabled', false);
		$(this).attr('disabled',true);

})

$('#container').on('click',":input[name^='disconnect']", function(){

		$(":input[class^='connect']").attr('disabled', true);
		$(":input[class^='disconnect']").attr('disabled', false);
		$(this).prev(":input[class^='connect']").attr('disabled', false);
		$(this).attr('disabled',true);

})

</script>
