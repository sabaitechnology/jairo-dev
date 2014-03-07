<div class="pageTitle">VPN: Clients</div>
<br>
<div id="vpnclients"></div>

<pre id="reply"></pre>
<pre id="testing"></pre>

<script src="/libs/jai-widgets-vpnclient.js"></script>
<script type="text/ecmascript">


$(function(){
	$("#vpnclients").widgetlist({ file: "vpnclients", widgetType: "vpnclient"
		// ,create: function()
{		// 	$("#testing").append("Create fires ("+ $(this).prop("tagName") +"/"+ $(this).attr("id") +").\n")
		// }
	});
});


</script>

