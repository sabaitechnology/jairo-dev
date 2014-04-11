<div class="pageTitle">VPN: Clients</div>
<br>
<div id="vpnclients"></div>

<br>
<div id="fileexample1"></div>
<br>
<div id="fileexample2"></div>

<pre id="reply"></pre>
<pre id="testing"></pre>

<script src="/libs/jai-widgets.js"></script>
<script src="/libs/jai-widgets-vpnclient.js"></script>
<script type="text/ecmascript">

$(function(){

	$("#vpnclients").widgetlist({ file: "vpnclients", widgetType: "vpnclient" });
		// ,create: function(){ $("#testing").append("Create fires ("+ $(this).prop("tagName") +"/"+ $(this).attr("id") +").\n") }
	// });

	$("#fileexample1").textfile();
	$("#fileexample2").textfile({
		file: {
			name: "UnrealFile.txt",
			content: "I am a file.\nI have things in me.\nTHINGS."
		}
	});

	var fileContentExample = $("#falseInput").html();

  $("#testing").html(fileContentExample);

});

</script>

<textarea id="falseInput" class="noshow">
Here is multiline string input
for Javascript.
It has no support for multiline strings
in declarations.
</textarea>