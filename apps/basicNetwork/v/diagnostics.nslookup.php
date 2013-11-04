<div class='pageTitle'>Diagnostics: NS Lookup</div>
<!-- 
TODO:
 -->

<div class='controlBox'><span class='controlBoxTitle'>NS Lookup</span>
	<div class='controlBoxContent'>
		
		<table class='controlTable smallwidth'><tbody>
			 <tr>
			 	<td>Domain</td>
			 	<td>
			 		<input id='ns_domain' name='ns_domain' />
			 		<input type='button' value='Lookup' id='Lookup' onclick='lookup()'>
			 	</td>
			 </tr>
		</tbody></table>
		
		<br>
		<textarea id='dnstxtarea' style="width: 90%; height: 30em" readonly
></textarea>
	
	</div> <!-- End Control box content -->
</div> <!-- end control box -->


<script type='text/ecmascript' src='php/etc.php?q=nslookup'></script>
<script type='text/ecmascript'>

	$('#ns_domain').val(nslookup.domain);

	function lookup(){
		$.ajax("php/diagnostics.nslookup.php", {
			success: function(o){
				$('#dnstxtarea').html('');
				$('#dnstxtarea').html(o);
			},
			dataType: "text",
			data: $("#fe").serialize()
		})
	};

	// lookup input if user presses 'enter'
	$(document).ready(function() {
		$('#ns_domain').keypress(function(event) {
			if (event.keyCode == 13) {
			event.preventDefault();
			lookup();
			}
		});
	});

</script>