<form id='fe'>
<div class='pageTitle'>Network: Wan</div>
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->
<div class='controlBox' class='noshow'>
<table>
<tbody>
 <tr><td>WAN Type</td><td>
  <select id='wan_type' name='wan_type' class='radioSwitchElement'>
   <option value='dhcp'>DHCP</option>
   <option value='static'>Static</option>
   <option value='lan'>LAN</option>
   <option value='disabled'>Disabled</option>
  </select>
 </td></tr>
 <tr><td>MTU</td><td><input id='wan_mtu' name='wan_mtu' /></td></tr>
 <tr><td>MAC</td><td><input id='wan_mac' name='wan_mac' /></td></tr>
</tbody>
<tbody id='wan_type_staticoptions' class=''>
 <tr><td>IP</td><td><input id='wanip' name='wan_ip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wan_mask' name='wan_mask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wan_gateway' name='wan_gateway' /></td></tr>
</tbody>
</table>

<!--

<input type='button' value='test' onclick='sub();'>

</div>
<div class='controlBox' class='noshow'>
<table>

<tr><td>DNS Servers</td><td>
<input id='dns_server_1' name='dns_server_1' /><br>
<input id='dns_server_2' name='dns_server_2' /><br>
<input id='dns_server_3' name='dns_server_3' /><br>
(These are the DNS servers the DHCP server will provide for devices on the LAN also.)
</td></tr>


<tr><td></td><td>
</td></tr>

</table>
</div>

<div class='controlBox' class='noshow'><table>
<tr><td>Server pool</td><td>
 <input id='ntp_server' name='ntp_server' />
</td></tr>
<tr><td>Time Zone</td><td>
 <input id='ntp_zone' name='ntp_zone' /><br>
 Automatic DST <input id='ntp_autodst' name='ntp_autodst' type='checkbox'>
</td></tr>
<tr><td>Update Interval</td><td>
 <input id='ntp_interval' name='ntp_interval' />
</td></tr>
<tr><td>Current Time</td><td>
 <input id='ntp_time' name='ntp_time' />
</td></tr>
</table>
</div>
-->
<div class='controlBox'><pre id='demo'></pre></div>

<script type='text/ecmascript' src='php/bin.etc.php?q=wan'></script>
<script type='text/ecmascript'>

$('#wan_type').radioswitch({
 value: wan.type,
 change: function(event,ui){
  $('#wantype_staticoptions')[(ui.value=='static'?'show':'hide')]();
 }
});
$('#wan_mtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
$('#wan_mac').macspinner()
$('#wan_mac').macspinner('value',wan.mac);
//$('#wan_mac').val(wan.mac);

$(function(){
 macf(macp(wan.mac));
});
</script>
</form>
