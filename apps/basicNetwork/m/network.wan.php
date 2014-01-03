<?php
 if (!headers_sent()){ header('Content-type: text/ecmascript'); }



return;

/* BEGIN jai.php */
//class jaiPage {
//	private $moi = null;
	function jaiPage($json){
		$moi = json_decode($json);
//		echo json_encode($moi, JSON_PRETTY_PRINT) ."\n";

	}
//}
/* END jai.php */
/* BEGIN jai WAN spec */
/*
$jaiWanSpec = <<<JAIWANSPEC
{
	"wan": {
		"if": { "type": "select", "values": [ "eth0", "eth1", "eth2", "eth3", "eth4" ] },
		"type": { "type": "select", "values": {
			"dhcp": null,
			"static": { "isSet": [ "ip", "mask", "gateway" ] }
		} },
		"ip": { "type": "ipAddress" },
		"mask": { "type": "ipMask" },
		"gateway": { "type": "ipAddress" },
		"mtu": { "type": "integerRange", "range": [ 0, 1500 ], "default": 1500 },
		"mac": { "type": "macAddress" }
	}
}
JAIWANSPEC;
*/
/* END jai WAN spec */
//new jaiPage(<<<JSONIN
jaiPage(<<<JSONIN
{
	"title": "Network: WAN",
	"sections": [
		{
			"heading": "WAN",
			"rows": [
				{
					"value": "wan.type",
					"label": "WAN Type",
					"type": "radioSwitchElement"
				}
			]
		}
	]
}
JSONIN
);

//return;

?>
<div class='pageTitle'>Network: WAN</div>
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->

<div class='controlBox'><span class='controlBoxTitle'>WAN</span>

	<div class='controlBoxContent'>
		<table class='controlTable'><tbody>
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
		</tbody></table>
	</div>
</div>

<div class='controlBox'>
	<span class='controlBoxTitle'>DNS</span>
	<div class='controlBoxContent'>
		<table class='controlTable'><tbody>
			<tr>
				<td class="DNSheading">DNS Servers</td>
				<td><div><ul id='dns_servers'></ul></div></td>
				<td class="description">
					<div  id='DNSdescription'>
						<span class ='xsmallText'>(These are the DNS servers the DHCP server will provide for devices also on the LAN)
						</span>
					</div>
				</td>
			</tr>
		</tbody></table>
	</div>
</div>


<script type='text/ecmascript' src='php/etc.php?q=wan,dns'></script>
<script type='text/ecmascript' src='js/globalize.js'></script>
<script type='text/ecmascript' src='js/time.js'></script>
<script type='text/ecmascript' src='/libs/jeditable.js'></script>
<script type='text/ecmascript'>

$(function(){

	$('#wan_mac').macspinner().macspinner('value',wan.mac);
	$('#wan_mtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
	$('#wan_gateway').ipspinner().ipspinner('value',wan.gateway);
	$('#wan_mask').maskspinner().maskspinner('value',wan.mask);
	$('#wan_ip').ipspinner().ipspinner('value',wan.ip);
	$('#wan_type').radioswitch({ value: wan.type, hasChildren: true });

	$('#dns_servers').editablelist({ list: dns.servers })

});
</script>
