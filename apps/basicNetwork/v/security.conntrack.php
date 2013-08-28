<div class='pageTitle'>Security: Conntrack</div>
<!-- TODO: 
onchange make input visible-->
<div class='controlBox'><span class='controlBoxTitle'>Connections</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td>Maximum Connections</td><td><input id="maxConnection" name="maxConnection" class='shortinput'>
					<a href="#">
					<span class='smallText'> [count current...]</span>
					</a>
				</td>
				</tr><tr><td>Hash Table Size</td><td><input id="hashTableSize" name="hashTableSize" class='shortinput'></td>
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
				<tr><td>Established</td><td><input id="established" name="established" class='shortinput'></td>
				</tr>
				<tr><td>SYN Sent</td><td><input id="synSent" name="synSent" class='shortinput'></td>
				</tr>
				<tr><td>SYN Received</td><td><input name="synReceived" id="synReceived" class='shortinput'></td>
				</tr>
				<tr><td>FIN Wait</td><td><input id="finWait" name="finWait" class='shortinput'></td>
				</tr>
				<tr><td>Time Wait</td><td><input id="timeWait" name="timeWait" class='shortinput'></td>
				</tr>
				<tr><td>Close</td><td><input id="close" name="close" class='shortinput'></td>
				</tr>
				<tr><td>Close Wait</td><td><input id="closeWait" name="closeWait" class='shortinput'></td>
				</tr>
				<tr><td>Last ACK</td><td><input id="lastAck" name="lastAck" class='shortinput'></td>
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
				<tr><td>Unreplied</td><td><input name="unreplied" id="unreplied" class='shortinput'></td>
				</tr>
				<tr><td>Assured</td><td><input id="assured" name="assured" class='shortinput'></td>
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
				<tr><td>Generic</td><td><input id="generic" name="generic"  class='shortinput'></td>
				</tr>
				<tr><td>ICMP</td><td><input id="icmp" name="icmp" class='shortinput'></td>
				</tr>
			</tbody>
		</table>
			
		
	</div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>Tracking/NAT Helpers</span>
	<div class='controlBoxContent'>
		<table>
			<tbody>
				<tr><td>FTP</td><td><input name="ftp" id="ftp" class='shortinput' type='checkbox'></td>
				</tr>
				<tr><td>GRE / PPTP </td><td><input name="gre" id="gre" class='shortinput' type='checkbox'></td>
				</tr>
				<tr><td>H.323</td><td><input name="h" id="h" class='shortinput' type='checkbox'></td>
				</tr>
				<tr><td>SIP</td><td><input name="sip" id="sip" class='shortinput' type='checkbox'></td>
				</tr>
				<tr><td>RTSP</td><td><input name="rtsp" id="rtsp" class='shortinput' type='checkbox'></td>
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
						<select id="ttlAdjust" onchange="" name="ttlAdjust">
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
				<tr><td>Inbound Layer</td><td><input id="inboundLayer" name="inboundLayer" class='shortinput' type='checkbox'>
					</td>
				</tr>
			</tbody>
		</table>
	



	
	</div>
</div>



<script type='text/ecmascript' src='php/bin.etc.php?q=conntrack'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>


 $('#maxConnection').val(conntrack.maxConnection);
 $('#hashTableSize').val(conntrack.hashTableSize);

 $('#established').val(conntrack.established);
 $('#synSent').val(conntrack.synSent);
 $('#synReceived').val(conntrack.synReceived);
 $('#finWait').val(conntrack.finWait)
 $('#timeWait').val(conntrack.timeWait);
 $('#close').val(conntrack.close);
 $('#closeWait').val(conntrack.closeWait);
 $('#lastAck').val(conntrack.lastAck);

 $('#unreplied').val(conntrack.unreplied);
 $('#assured').val(conntrack.assured);

 $('#generic').val(conntrack.generic);
 $('#icmp').val(conntrack.icmp);

 $('#ftp').prop({'checked': conntrack.ftp});
 $('#gre').prop({'checked': conntrack.gre});
 $('#h').prop({'checked': conntrack.h});
 $('#sip').prop({'checked':conntrack.sip});
 $('#rtsp').prop({'checked':conntrack.rtsp});

 $('#ttlAdjust').prop({'checked': conntrack.ttlAdjust});
 $('#inboundLayer').prop({'checked':conntrack.inboundLayer});

</script>