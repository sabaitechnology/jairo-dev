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
			<tr><td>Inactive Rules Cleaning</td><td></td>
			</tr>
			<tr><td>Secure Mode</td><td><span class='xsmallText'>(when enabled, UPnP clients are allowed to add mappings only to their IP)</span></td>
			</tr>
			<tr><td>Allowed UPnP Ports</td><td><span class='xsmallText'>	(UPnP clients will only be allowed to map ports in the external range to ports in the internal range)</span></td>
			</tr>
			<tr><td></td><td><span class='xsmallText'>(Setting the external lower bound here to less than 1024 may interfere with network services.)</span></td>
			</tr>
			<tr><td></td><td><span class='xsmallText'>(Valid port ranges are from 2 to 65535.)</span></td>
			</tr>


		</table>

	</div>
</div>