<form id='fe'>
<div class='pageTitle'>Network: Wan</div>
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->
<div class='controlBox'>
<table><tbody>
 <tr><td>Mode</td><td>
  <select id='wl0type' name='wl0type' class='radioSwitchElement'>
   <option value='off'>Off</option>
   <option value='server'>Wireless Server</option>
   <option value='client'>Wireless Client</option>
   <!-- <option value='wds'>WDS</option> -->
  </select>
 </td></tr>
 <tr><td>SSID</td><td><input id='wl0ssid' name='wl0ssid' /></td></tr>
</tbody>
</table>
</div>

<div class='controlBox'>
<table>
<tbody>
 <tr><td>Security</td><td>
  <select id='wl0security' name='wl0security' class='radioSwitchElement'>
   <option value='none'>None</option>
   <option value='wep'>WEP</option>
   <option value='wpapersonal'>WPA/WPA2 Personal</option>
<!-- 
   <option value='wpaenterprise'>WPA Enterprise</option>
   <option value='wpa2enterprise'>WPA2 Enterprise</option>
   <option value='radius'>Radius</option>
-->
  </select>
 </td></tr>

</tbody>
<tbody id='wl0security_wepoptions' class=''>
 <tr><td>WEP Keys</td><td>
  <input id='wl0wepkey0' name='wl0wepkey0' /><input type='radio' name='wl0webkeydefault' value='0' />(default)<br>
  <input id='wl0wepkey1' name='wl0wepkey1' /><input type='radio' name='wl0webkeydefault' value='1' /><br>
  <input id='wl0wepkey2' name='wl0wepkey2' /><input type='radio' name='wl0webkeydefault' value='2' /><br>
  <input id='wl0wepkey3' name='wl0wepkey3' /><input type='radio' name='wl0webkeydefault' value='3' />
 </td></tr>
</tbody>

<tbody id='wl0security_wpapersonaloptions' class=''>

 <tr><td>WPA Type</td><td>
  <select id='wl0wpatype' name='wl0wpatype' class='radioSwitchElement'>
   <option value='1'>WPA</option>
   <option value='2'>WPA2</option>
   <option value='3'>WPA/WPA2</option>
  </select>
 </td></tr>

 <tr><td>WPA Encryption</td><td>
  <select id='wl0wpaencryption' name='wl0wpaencryption' class='radioSwitchElement'>
   <option value='1'>AES</option>
   <option value='2'>TKIP</option>
   <option value='3'>AES/TKIP</option>
  </select>
 </td></tr>

 <tr><td>PSK</td><td><input id='wl0wpapsk' name='wl0wpapsk' /></td></tr>
 <tr><td>Key Duration</td><td><input id='wl0wparekey' name='wl0wparekey' /></td></tr>

</tbody>
<!--
<tbody id='wl0security_wpaenterpriseoptions' class='noshow'>

 <tr><td>IP</td><td><input id='wanip' name='wanip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wanmask' name='wanmask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wangateway' name='wangateway' /></td></tr>

</tbody>

<tbody id='wl0security_radiusoptions' class='noshow'>

 <tr><td>IP</td><td><input id='wanip' name='wanip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wanmask' name='wanmask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wangateway' name='wangateway' /></td></tr>

</tbody>
-->

</table>

<input type='button' value='test' onclick='sub();'>

</div>
<!--
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
-->
<div class='controlBox'><pre id='demo'></pre></div>

<script type='text/ecmascript'>
 var wan = {
  type: 'dhcp',
  mtu: 1440,
  mac: '01:02:03:01:02:03'
 }

$('#wanType').radioswitch({
 value: wan.type,
 change: function(event,ui){
  $('#wanType_staticoptions')[(ui.value=='static'?'show':'hide')]();
 }
});
$('#wanmtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
$('#wanmac').val(wan.mac);

$(function(){

});
</script>
</form>
