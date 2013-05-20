<form id='fe'>
<div class='pageTitle'>VPN: PPTP</div>
<div class='controlBox'>

<!-- TODO: pptp_mppe, pptp_stateful -->

<table><tbody>
<!--tr><td>Name</td><td><input id='pptp_name' name='pptp_name' /></td></tr -->
<tr><td>Server</td><td><input id='pptp_server' name='pptp_server' /></td></tr>
<tr><td>Username</td><td><input id='pptp_username' name='pptp_username' /></td></tr>
<tr><td>Password</td><td><input id='pptp_password' name='pptp_password' /></td></tr>
</tbody></table>

</div>

<div class='controlButtons'>
<input type='button' value='Start' onclick='PPTPsave("start")'>
<input type='button' value='Stop' onclick='PPTPsave("stop")'>
<input type='button' value='Save' onclick='PPTPsave("save")'>
<input type='button' value='Erase' onclick='PPTPsave("erase")'>
<input type='button' value='Cancel' onclick='javascript:reloadPage();'>
<input type='button' value='Help' onclick='window.open("http://www.sabaitechnology.com/v/sabaiHelp/help.html#pptp","_newtab");'><br>
<!-- table><tbody><tr><td id='footer' colspan=2><span id='footer-msg'></span></td></tr></tbody></table -->
</div>

</form>
<script type='text/javascript'>
var f;
var processing = ['Sav','Start','Stopp','Eras'];

function PPTPsave(act){ if(act==3 && !confirm("Erase all PPTP settings?")) return; E('processing').innerHTML = ['Sav','Start','Stopp','Eras'][act] +'ing...'; async(true);
 que.drop('s_sabaipptp.cgi', reloadPage, 'fire='+ act +'&pptp_user='+ f.pptp_user.value +'&pptp_pass='+ f.pptp_pass.value +'&pptp_server='+ f.pptp_server.value +'&pptp_mppe='+ (f.pptp_mppe.checked?'1':'0') +'&pptp_stateful='+ (f.pptp_stateful.checked?'1':'0') +'&_http_id='+nvram.http_id);
}

// function init(){ f=E('_fom'); new vpnStatus(); }

</script>
