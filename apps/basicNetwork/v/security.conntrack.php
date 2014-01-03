<div class='pageTitle'>Security: Conntrack</div>
<!-- TODO: onchange make input visible-->

<div id='accordion' class='noshow'>

	<h3>Connections</h3>
	<div>
		<table><tbody>
			<tr>
				<td>Maximum Connections</td>
				<td><input id="maxConnection" name="maxConnection" class='shortinput'>
						<a href="#"><span class='smallText'> [count current...]</span></a>
				</td>
			</tr>
			<tr>
				<td>Hash Table Size</td>
				<td><input id="hashTableSize" name="hashTableSize" class='shortinput'></td>
			</tr>
		</tbody></table>
		<input type='button' name='drop_idle' value='Drop Idle'>
	</div>

	<h3>TCP Timeout</h3>
	<div><table><tbody>
		<tr>
			<td> </td>
			<td><span class='xsmallText'> (seconds)</span></td>
		</tr>
		<tr>
			<td>Established</td>
			<td><input id="established" name="established" class='shortinput'></td>
		</tr>
		<tr>
			<td>SYN Sent</td>
			<td><input id="synSent" name="synSent" class='shortinput'></td>
		</tr>
		<tr>
			<td>SYN Received</td>
			<td><input name="synReceived" id="synReceived" class='shortinput'></td>
		</tr>
		<tr>
			<td>FIN Wait</td>
			<td><input id="finWait" name="finWait" class='shortinput'></td>
		</tr>
		<tr>
			<td>Time Wait</td>
			<td><input id="timeWait" name="timeWait" class='shortinput'></td>
		</tr>
		<tr>
			<td>Close</td>
			<td><input id="close" name="close" class='shortinput'></td>
		</tr>
		<tr>
			<td>Close Wait</td>
			<td><input id="closeWait" name="closeWait" class='shortinput'></td>
		</tr>
		<tr>
			<td>Last ACK</td>
			<td><input id="lastAck" name="lastAck" class='shortinput'></td>
		</tr>
	</tbody></table></div>

	<h3>UDP Timeout</h3>
	<div><table><tbody>
		<tr>
			<td> </td>
			<td><span class='xsmallText'> (seconds)</span></td>
		</tr>
		<tr>
			<td>Unreplied</td>
			<td><input name="unreplied" id="unreplied" class='shortinput'></td>
		</tr>
		<tr>
			<td>Assured</td>
			<td><input id="assured" name="assured" class='shortinput'></td>
		</tr>
	</tbody></table></div>

	<h3>Other Timeouts</h3>
	<div><table><tbody>
		<tr>
			<td> </td>
			<td><span class='xsmallText'> (seconds)</span></td>
		</tr>
		<tr>
			<td>Generic</td>
			<td><input id="generic" name="generic"  class='shortinput'></td>
		</tr>
		<tr>
			<td>ICMP</td>
			<td><input id="icmp" name="icmp" class='shortinput'></td>
		</tr>
	</tbody></table></div>

	<h3>Tracking/NAT Helpers</h3>
	<div><table><tbody>
		<tr>
			<td>FTP</td>
			<td><input name="ftp" id="ftp" class='shortinput' type='checkbox'></td>
		</tr>
		<tr>
			<td>GRE / PPTP </td>
			<td><input name="gre" id="gre" class='shortinput' type='checkbox'></td>
		</tr>
		<tr>
			<td>H.323</td>
			<td><input name="h" id="h" class='shortinput' type='checkbox'></td>
		</tr>
		<tr>
			<td>SIP</td>
			<td><input name="sip" id="sip" class='shortinput' type='checkbox'></td>
		</tr>
		<tr>
			<td>RTSP</td>
			<td><input name="rtsp" id="rtsp" class='shortinput' type='checkbox'></td>
		</tr>
	</tbody></table></div>

	<h3>Miscellaneous</h3>
	<div><table><tbody>
		<tr>
			<td>TTL Adjust</td>
			<td class="content">
				<select id="ttlAdjust" onchange="showInput()" name="ttlAdjust">
					<option value="-5">-5</option>
					<option value="-4">-4</option>
					<option value="-3">-3</option>
					<option value="-2">-2</option>
					<option value="-1">-1</option>
					<option value="None">None</option>
					<option value="1">+1</option>
					<option value="2">+2</option>
					<option value="3">+3</option>
					<option value="4">+4</option>
					<option value="5">+5</option>
					<option value="Custom">Custom</option>
				</select>
				<input type="text" id="ttl_custom" class='noshow' onchange="" size="6" maxlength="3" name="ttl_custom">
			</td>
		</tr>
		<tr>
			<td>Inbound Layer</td>
			<td><input id="inboundLayer" name="inboundLayer" class='shortinput' type='checkbox'></td>
		</tr>
	</tbody></table></div>

</div> <!-- end accordion -->
<br>
<input type='button' value='Save' id='save'>


<script type='text/ecmascript' src='php/etc.php?q=conntrack'></script>
<script type='text/ecmascript'>

$(function() {
	$('#accordion').accordion({
    active:false,
    animate: false,
    collapsible:true,
    heightStyle:"content",
  });
  $('#accordion').show();
 })


$('#maxConnection').spinner({ min: 0, max: 50000 }).spinner('value',conntrack.maxConnection);
$('#hashTableSize').spinner({ min: 0, max: 50000 }).spinner('value',conntrack.hashTableSize);

$('#established').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.established);
$('#synSent').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.synSent);
$('#synReceived').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.synReceived);
$('#finWait').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.finWait);
$('#timeWait').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.timeWait);
$('#close').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.close);
$('#closeWait').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.closeWait);
$('#lastAck').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.lastAck);

$('#unreplied').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.unreplied);
$('#assured').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.assured);

$('#generic').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.generic);
$('#icmp').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.icmp);

$('#closeWait').spinner({ min: 0, max: 3600 }).spinner('value',conntrack.closeWait);

 $('#ftp').prop({'checked': conntrack.ftp});
 $('#gre').prop({'checked': conntrack.gre});
 $('#h').prop({'checked': conntrack.h});
 $('#sip').prop({'checked':conntrack.sip});
 $('#rtsp').prop({'checked':conntrack.rtsp});

 $('#ttlAdjust').val(conntrack.ttlAdjust);
 $('#ttl_custom').spinner({ min: -255, max: 255 }).spinner('value',conntrack.custom);
 $('#inboundLayer').prop({'checked':conntrack.inboundLayer});

 function showInput() {
 	$('#ttl_custom').show();
 }

</script>