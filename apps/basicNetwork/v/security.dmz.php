<div class='pageTitle'>Security: DMZ</div>
<!-- TODO: -->

<div class='controlBox'><span class='controlBoxTitle'>DMZ</span>
	<div class='controlBoxContent'>

		<input type="checkbox" id="dmzToggle" name='dmzToggle' class="slideToggle"/>
		<label class="slideToggleViewport" for="dmzToggle">
			<div class="slideToggleSlider">
			  <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
			  <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
			  <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
			</div>
		</label>
		<table>
		 	<tr><td>Destination Address</td> <td><input id='dmz_destination' name='dmz_destination'></input><td></tr>
		 	<tr><td>Source Address Restriction</td> <td> <input name='dmz_drestriction' disabled></input> </td></tr>
		</table>
		<div><span class='xsmallText'>
			(optional; ex: "1.1.1.1", "1.1.1.0/24", "1.1.1.1 - 2.2.2.2" or "me.example.com")
		</span></div>

	</div>
</div>


<script type='text/ecmascript' src='php/etc.php?q=dmz'></script>
<script type='text/ecmascript'>

	$('#destination').ipspinner().ipspinner('value',dmz.destination).spinner({
    disabled: true
   });

	$("input[name=dmzToggle]").change(function(){

		if( $("input[name=dmzToggle]").is(":checked") ) {
	    $("input[name=destination]").attr("disabled", false).spinner({
	      disabled: false
	    });
	    $("input[name=restriction]").attr("disabled", false);
		} else {
		$("input[name=destination]").attr("disabled", true).spinner({
		  disabled: true
		});
		
		$("input[name=restriction]").attr("disabled", true);
		}

	});

</script>