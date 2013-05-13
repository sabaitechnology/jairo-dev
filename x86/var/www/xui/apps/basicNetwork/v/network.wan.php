<form id='fe'>
<div class='pageTitle'>Network: Wan</div>
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->
<div class='controlBox'>
<table>
<tbody>
 <tr><td>WAN Type</td><td>
  <select id='wantype' name='wantype' class='radioSwitchElement'>
   <option value='dhcp'>DHCP</option>
   <option value='static'>Static</option>
   <option value='lan'>LAN</option>
   <option value='disabled'>Disabled</option>
   <!-- <option value='pppoe'>PPPoE</option> -->
  </select>
 </td></tr>
 <tr><td>MTU</td><td><input id='wanmtu' name='wanmtu' /></td></tr>
 <tr><td>MAC</td><td><input id='wanmac' name='wanmac' /></td></tr>
</tbody>
<tbody id='wantype_staticoptions' class='noshow'>
 <tr><td>IP</td><td><input id='wanip' name='wanip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wanmask' name='wanmask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wangateway' name='wangateway' /></td></tr>
</tbody>
</table>

<input type='button' value='test' onclick='sub();'>

</div>

<div class='controlBox'>
<table>

<tr><td>DNS Servers</td><td>
<input id='wandns1' name='wandns1' /><br>
<input id='wandns2' name='wandns2' /><br>
<input id='wandns3' name='wandns3' /><br>
(These are the DNS servers the DHCP server will provide for devices on the LAN also.)
</td></tr>


<tr><td></td><td>
</td></tr>

</table>
</div>

<div class='controlBox'><table>
<tr><td>Server pool</td><td>
 <input id='ntpserver' name='ntpserver' />
</td></tr>
<tr><td>Time Zone</td><td>
 <input id='ntpzone' name='ntpzone' /><br>
 Automatic DST <input id='ntpautodst' name='ntpautodst' type='checkbox'>
</td></tr>
<tr><td>Update Interval</td><td>
 <input id='ntpinterval' name='ntpinterval' />
</td></tr>
<tr><td>Current Time</td><td>
 <input id='ntptime' name='ntptime' />
</td></tr>
</table></div>

<div class='controlBox'><pre id='demo'></pre></div>

<script type='text/ecmascript'>
 var wan = {
  type: 'dhcp',
  mtu: 1440,
  mac: '01:02:03:01:02:03'
 }

$('#wantype').radioswitch({
 value: wan.type,
 change: function(event,ui){
  $('#wantype_staticoptions')[(ui.value=='static'?'show':'hide')]();
 }
});
$('#wanmtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
$('#wanmac').val(wan.mac);

$(function(){

});
</script>
</form>
