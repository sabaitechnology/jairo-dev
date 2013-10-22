<div class='pageTitle'>Diagnostics: NS Lookup</div>
<!-- 
TODO:
 -->

<div class='controlBox'><span class='controlBoxTitle'>NS Lookup</span>
	<div class='controlBoxContent'>
	<br>
	<table class='controlTable smallwidth'>
		<tbody>
		 <tr>
		 	<td>Domain</td>
		 	<td>
		 		<input id='ns_domain' name='ns_domain' />
		 		<input type='button' value='Lookup' id='Lookup' onclick='lookup()'>
		 	</td>
		 </tr>
		</tbody>
	</table><br>
	<textarea id='logstxtarea' class='noshow' style="width: 90%; height: 30em" readonly
>			
	</textarea>


</div>

<script type='text/ecmascript' src='php/bin.etc.php?q=nslookup'></script>
<script type='text/ecmascript'>

$('#ns_domain').val(nslookup.domain);

function lookup(){

	$.ajax("php/bin.diagnostics.nslookup.php", {
			success: function(o){
				$('#logstxtarea').html('');
				$('#logstxtarea').show().html(o);
			},
			dataType: "text",
			data: $("#fe").serialize()
		})

};

$(document).ready(function() {

	$('#ns_domain').keypress(function(event) {
		if (event.keyCode == 13) {
		event.preventDefault();
		lookup();
		}
	});

});

</script>