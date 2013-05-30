<form id='fe'>
<div class='pageTitle'>Wireless: Radio</div>
<!--	TODO:
-->
<div class='controlBox'><span class='controlBoxTitle'>WL0</span><div class='controlBoxContent'>

<table>
<tbody>
 <tr><td>Mode</td><td>
  <select id='wl0_type' name='wl0_type' class='radioSwitchElement'>
   <option value='off'>Off</option>
   <option value='server'>Wireless Server</option>
   <option value='client'>Wireless Client</option>
   <!-- <option value='wds'>WDS</option> -->
  </select>
 </td></tr>
</tbody>

<tbody class='wl0_type wl0_type-server wl0_type-client'>
 <tr><td>SSID</td><td><input id='wl0_ssid' name='wl0_ssid' /></td></tr>
 <tr><td>Security</td><td>
  <select id='wl0_security' name='wl0_security' class='radioSwitchElement'>
   <option value='none'>None</option>
   <option value='wep'>WEP</option>
   <option value='wpapersonal'>WPA Personal</option>
<!-- 
   <option value='wpaenterprise'>WPA Enterprise</option>
   <option value='wpa2enterprise'>WPA2 Enterprise</option>
   <option value='radius'>Radius</option>
-->
  </select>
 </td></tr>

 <tr><td colspan=2>
 <table>

<tbody class='wl0_security wl0_security-wep'>
 <tr><td>WEP Keys</td><td>
  <input id='wl0_wep_key_0' name='wl0_wep_key_0' /><input type='radio' name='wl0_wep_keydefault' value='0' />(default)<br>
  <input id='wl0_wep_key_1' name='wl0_wep_key_1' /><input type='radio' name='wl0_wep_keydefault' value='1' /><br>
  <input id='wl0_wep_key_2' name='wl0_wep_key_2' /><input type='radio' name='wl0_wep_keydefault' value='2' /><br>
  <input id='wl0_wep_key_3' name='wl0_wep_key_3' /><input type='radio' name='wl0_wep_keydefault' value='3' />
 </td></tr>
</tbody>

<tbody class='wl0_security wl0_security-wpapersonal'>
 <tr><td>WPA Type</td><td>
<!--	TODO:
	Add bit flipping switch for and/or options.
-->
  <select id='wl0_wpa_type' name='wl0_wpa_type' class='radioSwitchElement'>
   <option value='1'>WPA</option>
   <option value='2'>WPA2</option>
   <option value='3'>WPA/WPA2</option>
  </select>
 </td></tr>
 <tr><td>WPA Encryption</td><td>
  <select id='wl0_wpa_encryption' name='wl0_wpa_encryption' class='radioSwitchElement'>
   <option value='1'>AES</option>
   <option value='2'>TKIP</option>
   <option value='3'>AES/TKIP</option>
  </select>
 </td></tr>
 <tr><td>PSK</td><td><input id='wl0_wpa_psk' name='wl0_wpa_psk' /></td></tr>
 <tr><td>Key Duration</td><td><input id='wl0_wpa_rekey' name='wl0_wpa_rekey' /></td></tr>
</tbody>

<!--
<tbody class='wl0_security-wpaenterprise noshow'>
 <tr><td>IP</td><td><input id='wanip' name='wanip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wanmask' name='wanmask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wangateway' name='wangateway' /></td></tr>
</tbody>

<tbody class='wl0_security-radius noshow'>
 <tr><td>IP</td><td><input id='wanip' name='wanip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wanmask' name='wanmask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wangateway' name='wangateway' /></td></tr>
</tbody>
-->
 </table>
 </td></tr>
</tbody>

</table>

</div></div>

<input type='button' value='test' onclick='sub();'>

<div class='controlBox'><span class='controlBoxTitle'>Demo</span><div class='controlBoxContent'><pre id='demo'></pre></div></div>

<script type='text/ecmascript' src='php/bin.etc.php?q=wl&n=0'></script>
<script type='text/ecmascript'>

$('#wl0_type').radioswitch({
 value: wl[0].type,
 change: function(event,ui){ $('.wl0_type').hide(); $('.wl0_type-'+ ui.value ).show(); }
});

$('#wl0_security').radioswitch({
 value: wl[0].security,
 change: function(event,ui){ $('.wl0_security').hide(); $('.wl0_security-'+ ui.value ).show(); }
});

$('#wl0_wpa_type').radioswitch({
 value: wl[0].wpa.type
});

$('#wl0_wpa_encryption').radioswitch({
 value: wl[0].wpa.encryption
});

//$('#wanmtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
//$('#wanmac').val(wan.mac);

$(function(){

});
</script>
</form>
