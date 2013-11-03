<div class='pageTitle'>Security: UPnP</div>

<div class='controlBox'><span class='controlBoxTitle'>Settings</span>
	<div class='controlBoxContent'><table><tbody>
		<tr><td>Enable UPnP</td>
			<td><input type="checkbox" id="dmzToggle" name='dmzToggle' class="slideToggle" />
				 <label class="slideToggleViewport" for="dmzToggle">
				 <div class="slideToggleSlider">
				   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
				   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
				   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
				  </div>
				 </label>
			</td>
		</tr>
		<tr><td>Inactive Rules Cleaning</td>
			<td><input type="checkbox" id="rulesToggle" name='rulesToggle' class="slideToggle" />
			 	<label class="slideToggleViewport" for="rulesToggle">
				 <div class="slideToggleSlider">
				   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
				   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
				   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
				  </div>
				</label>
			</td>
		</tr>
		<tr><td>Secure Mode</td>
			<td><input type="checkbox" id="secureToggle" name='secureToggle' class="slideToggle" /> 
				<label class="slideToggleViewport" for="secureToggle">
				 <div class="slideToggleSlider">
				   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
				   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
				   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
				  </div>
				 </label>
			</td>
		</tr>
		<tr>
			<td> </td>
			<td><span class='xsmallText'>
				When enabled, UPnP clients are allowed to add mappings only to their IP</span>
			</td>
		</tr>
	</tbody></table></div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>Allowed UPnP Ports*</span>
	<div class='controlBoxContent'>
		<table><tbody>
			<tr><td>Internal Ports</td><td><input id='internalLB' name='internalLB' class='shortinput'/> - <input id='internalUB' name='internalUB' class='shortinput'/>
			</tr>
			<tr>
				<td> </td>
				<td>
				<span class='xsmallText'>Valid port ranges are from 2 to 65535</span></td>
				</td>
			</tr>
			<tr><td><br> </td><td><br> </td></tr>
			<tr><td>External Ports</td><td><input id='externalLB' name='externalLB' class='shortinput'/> - <input id='externalUB' name='externalUB' class='shortinput'/>
			</tr>
			<tr>
				<td> </td>
				<td>
					<span class='xsmallText'>Setting lower bound to less than 1024 may interfere with network services</span>
				</td>
			</tr>
			<tr>
				<td> </td>
				<td>
					<span class='xsmallText'><input type='checkbox' id='advanced' name='advanced' onChange='changeRange();'>Allow advanced settings</span>
				</td>
			</tr>
			<tr><td><br> </td><td><br> </td></tr>
			<tr><td>Show In My Network Places</td>
				<td><input type="checkbox" id="showToggle" name='showToggle' class="slideToggle" /> 
					<label class="slideToggleViewport" for="showToggle">
					 <div class="slideToggleSlider">
					   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
					   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
					   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
					  </div>
					 </label>
					
				</td>
			</tr>
		</tbody></table>
		<br>
		<span class='xsmallText'> *UPnP clients will only be allowed to map ports in the external range to ports in the internal range</span>

	</div>
</div>


<script type='text/ecmascript' src='php/etc.php?q=upnp'></script>
<script type='text/javascript'>

	$('#internalLB').spinner({ min: 1024, max: 65534 }).spinner('value',upnp.internalLB);
		$('#internalUB').spinner({ min: 1025, max: 65535}).spinner('value',upnp.internalUB);
		$('#externalLB').spinner({ min: 1024, max: 65534 }).spinner('value',upnp.externalLB);
		$('#externalUB').spinner({ min: 1025, max: 65535 }).spinner('value',upnp.externalUB);

	function changeRange(){
		if($('#advanced').is(':checked')){
			$('#internalLB').spinner({ min: 2, max: 65534 });
			$('#internalUB').spinner({ min: 3, max: 65535});
			$('#externalLB').spinner({ min: 2, max: 65534 });
			$('#externalUB').spinner({ min: 3, max: 65535 });
		} else {
			$('#internalLB').spinner({ min: 1024, max: 65534 });
			$('#internalUB').spinner({ min: 1025, max: 65535});
			$('#externalLB').spinner({ min: 1024, max: 65534 });
			$('#externalUB').spinner({ min: 1025, max: 65535 });
		}

	};

</script>
