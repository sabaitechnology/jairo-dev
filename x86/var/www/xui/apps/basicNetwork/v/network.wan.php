<div class='pageTitle'>Network: Wan</div>
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->

<div class='controlBox'><span class='controlBoxTitle'>WAN</span><div class='controlBoxContent'><table>
<tbody>
 <tr><td>WAN Type</td><td>
  <select id='wan_type' name='wan_type' class='radioSwitchElement'>
   <option value='dhcp'>DHCP</option>
   <option value='static'>Static</option>
   <option value='lan'>LAN</option>
   <option value='disabled'>Disabled</option>
  </select>
 </td></tr>
</tbody>
<tbody class='wan_type wan_type-static'>
 <tr><td>IP</td><td><input id='wan_ip' name='wan_ip' /></td></tr>
 <tr><td>Network Mask</td><td><input id='wan_mask' name='wan_mask' /></td></tr>
 <tr><td>Gateway</td><td><input id='wan_gateway' name='wan_gateway' /></td></tr>
</tbody>
<tbody class='wan_type wan_type-dhcp wan_type-static'>
 <tr><td>MTU</td><td><input id='wan_mtu' name='wan_mtu' /></td></tr>
 <tr><td>MAC</td><td><input id='wan_mac' name='wan_mac' /></td></tr>
</tbody>
</table></div></div>

<div class='controlBox'><span class='controlBoxTitle'>DNS</span><div class='controlBoxContent'><table>
<tbody>
<tr><td>DNS Servers</td><td>
 <input type='hidden' id='dns_servers' name='dns_servers'>
 <ul id='dns_server_list' class='editableList'></ul>
 <br>
 <input type='button' value='Add' onclick='addLI("dns_server_list")'>

 <!--ul id='dns_list'></ul -->
</td></tr>
<tr><td colspan=2>(These are the DNS servers the DHCP server will provide for devices on the LAN also.)</td></tr>
</tbody>
</table></div></div>

<input type='button' value='test' onclick='sub();'>

<div class='controlBox'>
 <span class='controlBoxTitle'>Demo</span>
 <div class='controlBoxContent'>
  <pre id='demo'>Demo!</pre>
 </div>
</div>

<script type='text/ecmascript' src='php/bin.etc.php?q=wan,dns'></script>
<script type='text/ecmascript' src='js/globalize.js'></script>
<script type='text/ecmascript' src='js/time.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

$('#wan_mtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
$('#wan_mac').macspinner().macspinner('value',wan.mac);
$('#wan_ip').ipspinner().ipspinner('value',wan.ip);
$('#wan_mask').maskspinner().maskspinner('value',wan.mask);
$('#wan_gateway').ipspinner().ipspinner('value',wan.gateway);

$('#wan_type').radioswitch({
 value: wan.type,
 change: function(event,ui){ $('.wan_type').hide(); $('.wan_type-'+ ui.value ).show(); }
});

//$('#dns_list').html( $.map(dns,function(v,i){ return "<li>"+v +"</li>"; }).join('\n') ).sortable();
//$('#dns_list li').editable(function(value, settings){ return value; }, { 'onblur':'submit', 'event': 'dblclick' });

 makeEditableList(dns.servers,'#dns_server_list','#dns_servers');

//$(function(){});
</script>
