<div class='pageTitle'>Diagnostics: NS Lookup</div>
<!-- 
TODO:
turn this into a form to get something other than google :) 
 -->

<div class='controlBox'><span class='controlBoxTitle'>NS Lookup</span>
	<div class='controlBoxContent'>

	<table class='controlTable'>
		<tbody>
		 <tr><td>Domain</td><td><input id='ns_domain' name='ns_domain' /><input type='button' value='Lookup' id='Lookup' onclick='lookup()'></td></tr>
		 <!-- <tr><td>IP Address</td><td><input id='ns_address' name='ns_address' /></td></tr> -->
		</tbody>
	</table>
	<textarea id='logstxtarea' style="width: 90%; height: 30em" readonly>  
			
			<?php

				$ip = gethostbynamel('www.google.com');

				$addrs = count($ip);

				echo("Returned $addrs addresses\n");

				for ($i = 0 ; $i < $addrs ; $i++)
			        echo("Address " . $ip[$i] . "\n");

			?>
			
	</textarea>


</div>

<script type='text/ecmascript' src='php/bin.etc.php?q=nslookup'></script>
<script type='text/ecmascript'>

$(function(){
 $('#ns_domain').val(nslookup.domain);
});


</script>