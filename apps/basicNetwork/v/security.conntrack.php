<div class='pageTitle'>Security: Conntrack</div>
<!-- TODO: 
onchange make input visible-->
<div class='controlBox'><span class='controlBoxTitle'>Connections</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td>Maximum Connections</td><td><input class='shortinput' value='8192'>
					<a href="#">
					<span class='smallText'> [count current...]</span>
					</a>
				</td>
				</tr><tr><td>Hash Table Size</td><td><input class='shortinput' value='2048'></td>
				</tr>
			</tbody>
		</table>

		<input type='button' name='drop_idle' value='Drop Idle'>
	</div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>TCP Timeout</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td> </td><td><span class='xsmallText'> (seconds)</span></td>
				</tr>
				<tr><td>Established</td><td><input class='shortinput' value='1800'></td>
				</tr>
				<tr><td>SYN Sent</td><td><input class='shortinput' value='30'></td>
				</tr>
				<tr><td>SYN Received</td><td><input class='shortinput' value='20'></td>
				</tr>
				<tr><td>FIN Wait</td><td><input class='shortinput' value='20'></td>
				</tr>
				<tr><td>Time Wait</td><td><input class='shortinput' value='20'></td>
				</tr>
				<tr><td>Close</td><td><input class='shortinput' value='10'></td>
				</tr>
				<tr><td>Close Wait</td><td><input class='shortinput' value='20'></td>
				</tr>
				<tr><td>Last ACK</td><td><input class='shortinput' value='20'></td>
				</tr>
			</tbody>
		</table>
			
				

	</div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>UDP Timeout</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td> </td><td><span class='xsmallText'> (seconds)</span></td>
				</tr>
				<tr><td>Unreplied</td><td><input class='shortinput' value='30'></td>
				</tr>
				<tr><td>Assured</td><td><input class='shortinput' value='180'></td>
				</tr>
			</tbody>
		</table>
			
	</div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>Other Timeouts</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td> </td><td><span class='xsmallText'> (seconds)</span></td>
				</tr>
				<tr><td>Generic</td><td><input class='shortinput' value='10'></td>
				</tr>
				<tr><td>ICMP</td><td><input class='shortinput' value='10'></td>
				</tr>
			</tbody>
		</table>
			
		
	</div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>Tracking/NAT Helpers</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td>FTP</td><td><input class='shortinput' type='checkbox' checked='checked'></td>
				</tr>
				<tr><td>GRE / PPTP </td><td><input class='shortinput' type='checkbox' checked='checked'></td>
				</tr>
				<tr><td>H.323</td><td><input class='shortinput' type='checkbox' checked='checked'></td>
				</tr>
				<tr><td>SIP</td><td><input class='shortinput' type='checkbox' checked='checked'></td>
				</tr>
				<tr><td>RTSP</td><td><input class='shortinput' type='checkbox'></td>
				</tr>
			</tbody>
		</table>
			 
		
			
			
		
	</div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>Miscellaneous</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td>TTL Adjust</td>
					<td class="content">
						<select id="ttl_adjust" onchange="" name="ttl_adjust">
							<option value="-5">-5</option>
							<option value="-4">-4</option>
							<option value="-3">-3</option>
							<option value="-2">-2</option>
							<option value="-1">-1</option>
							<option selected="" value="0">None</option>
							<option value="1">+1</option>
							<option value="2">+2</option>
							<option value="3">+3</option>
							<option value="4">+4</option>
							<option value="5">+5</option>
							<option value="">Custom</option>
						</select>
						<input type="text" id="ttl_custom" onchange="" size="6" maxlength="3" value="" name="ttl_custom" style="display: none;">
					</td>
				</tr>
				<tr><td>Inbound Layer</td><td><input class='shortinput' type='checkbox' checked='checked'>
					</td>
				</tr>
			</tbody>
		</table>
	



	
	</div>
</div>

