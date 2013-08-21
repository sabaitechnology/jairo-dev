<div class='pageTitle'>VPN: Open VPN</div>
<!-- TODO: 

same as pptp +
make your own config wizard -->

<div class='controlBox'><span class='controlBoxTitle'>Open VPN</span>
	<div class='controlBoxContent'>
		<span class='smallText'>Upload File</span>
	</div>
</div>

<div class='controlButtons'>
<input type='button' value='Start' id='Start' onclick='PPTPsave("start")'>
<input type='button' value='Stop' onclick='PPTPsave("stop")'>
<input type='button' value='Save' onclick='PPTPsave("save")'>
<input type='button' value='Erase' onclick='PPTPsave("erase")'>
<input type='button' value='Cancel' onclick='javascript:reloadPage();'>
<input type='button' value='Help' onclick='window.open("http://www.sabaitechnology.com/v/sabaiHelp/help.html#pptp","_newtab");'><br>
<!-- table><tbody><tr><td id='footer' colspan=2><span id='footer-msg'></span></td></tr></tbody></table -->
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=vpn'></script>
<script type='text/javascript'>
//var f;
//var processing = ['Sav','Start','Stopp','Eras'];

//function PPTPsave(act){ if(act==3 && !confirm("Erase all PPTP settings?")) return; E('processing').innerHTML = ['Sav','Start','Stopp','Eras'][act] +'ing...'; async(true);
// que.drop('s_sabaipptp.cgi', reloadPage, 'fire='+ act +'&pptp_user='+ f.pptp_user.value +'&pptp_pass='+ f.pptp_pass.value +'&pptp_server='+ f.pptp_server.value +'&pptp_mppe='+ (f.pptp_mppe.checked?'1':'0') +'&pptp_stateful='+ (f.pptp_stateful.checked?'1':'0') +'&_http_id='+nvram.http_id);
//}

// function init(){ f=E('_fom'); new vpnStatus(); }

</script>
