<div class="pageTitle">VPN: Clients</div>
<br>
<div id="vpnclients"></div>

<pre id="reply"></pre>
<pre id="testing"></pre>

<script src="/libs/jai-widgets-vpnclient.js"></script>
<script type="text/ecmascript">


$(function(){
	$("#vpnclients").widgetlist({ file: "vpnclients", widgetType: "vpnclient" });
		// ,create: function(){ $("#testing").append("Create fires ("+ $(this).prop("tagName") +"/"+ $(this).attr("id") +").\n") }
	// });

	// $("#testing").append("\tRequest:\n");
	// ro.send("Data String", "cdata", function(data){
	// 	$("#testing").append("BEGIN:\n");
	// 	$("#testing").append(data);
	// 	$("#testing").append("\n:END\n");
	// });


});

// $.ajax()

</script>

