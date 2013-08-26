<div class='pageTitle'>Security: UPnP</div>

<div class='controlBox'><span class='controlBoxTitle'>Settings</span>
	<div class='controlBoxContent'>
		
		<table>
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
					<td>
						<span class='xsmallText'>When enabled, UPnP clients are allowed to add mappings only to their IP</span>
					</td>
				</td>
			</tr>
			<tr><td><br> </td><td><br> </td></tr>
			<tr><td><b>Allowed UPnP Ports*</b></td>
			</tr>
			<tr><td>Internal Ports</td><td><input id='internalLB' name='internalLB' class='shortinput'/>- <input id='internalUB' name='internalUB' class='shortinput'/>
				<td>
				<span class='xsmallText'>Valid port ranges are from 2 to 65535</span></td>
				</td>
			</tr>
			<tr><td>External Ports</td><td><input id='externalLB' name='externalLB' class='shortinput'/>- <input id='externalUB' name='externalUB' class='shortinput'/>
				<td>
					<span class='xsmallText'>Setting lower bound to less than 1024 may interfere with network services</span>
				</td>
			</tr>
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

		</table>
		<br>
			<span class='xsmallText'> *UPnP clients will only be allowed to map ports in the external range to ports in the internal range</span>

	</div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=upnp'></script>
<script type='text/javascript'>

$(function(){
$('#internalLB').val(upnp.internalLB);
$('#internalUB').val(upnp.internalUB);
$('#externalLB').val(upnp.externalLB);
$('#externalUB').val(upnp.externalUB);
});

</script>
