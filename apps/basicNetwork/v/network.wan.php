<div class='pageTitle'>JaiRo Manual</div>
<br>

<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='wan'></a>WAN</span>
  <div class='controlBoxContent'>
    WAN Type, MTU, MAC, DNS
    <span class='smallText'><br><br><b>MAC Address-</b> MAC Address Media Access Control Address, MAC addresses are distinct addresses on the device level and is comprised of a manufacturer number and serial number.</span>  
    <span class='smallText'><br><br><b>DNS-</b> DNS Domain Name System, translates people-friendly domain names (www.google.com) into computer-friendly IP addresses (1.1.1.1). Â DNS is especially important for VPNs as some countries return improper results for domains intentionally as a way of blocking that web site.</span>
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='lan'></a>LAN</span>
  <div class='controlBoxContent'>
    LAN IP, Mask, DHCP Server, Lease/Range
    <span class='smallText'><br><br><b>DHCP-</b> Dynamic Host Configuration Protocol, the method by which routers assign IP addresses automatically. This allows you to connect to the coffee shop wireless even after more than 254 people have already; IP addresses are recycled as wireless clients come and go.</span>
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='time'></a>Time</span>
  <div class='controlBoxContent'>
    NTP, Server Pool
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='devicelist'></a>Device List</span>
  <div class='controlBoxContent'>
    Device List
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='staticips'></a>Static IPs</span>
  <div class='controlBoxContent'>
    Static Devices
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='radio'></a>Radio</span>
  <div class='controlBoxContent'>
    Mode, SSID, Security, Type, Encription, PSK, Duration
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='survey'></a>Survey</span>
  <div class='controlBoxContent'>
    Wireless Site Survey, Expiration, Refresh
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='macfilter'></a>MAC Filter</span>
  <div class='controlBoxContent'>
    Policy
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='pptp'></a>PPTP</span>
  <div class='controlBoxContent'>
    PPTP
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='openvpn'></a>Open VPN</span>
  <div class='controlBoxContent'>
    OpenVPN, Configuration
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='l2tp'></a>L2TP</span>
  <div class='controlBoxContent'>
    <span class='smallText'><br><b>L2TP-</b> L2TP Layer 2 Tunneling Protocol, another form of VPN, L2TP is more secure and stable than PPTP and usually faster, although application effects this speed. L2TP uses encryption that, like OpenVPN, is based on OpenSSL and AES. Â This, like with OpenVPN, can be changed (but usually isn't). Learn more about Sabai and L2TP.</span>
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='ipsec'></a>IPSEC</span>
  <div class='controlBoxContent'>
    <span class='smallText'><br><b>IPSEC-</b> IPsec Internet Protocol Security, an encryption method used in VPN. Requires client software to be accessed by each device. IPSEC is important because unlike with PPTP and OpenVPN, where packets are encrypted and sent out through normal packets, IPSEC encrypts them at a more fundamental layer. All packets between two machines with IPSEC set up are encrypted (not just those routed through a tunnel). Â IPSEC is essentially an agreement to encrypt communications between the two devices, which is why L2TP needs PPP for routing. Â Encrypting all packets between a client and server is not enough to set up a VPN; that also requires the client to forward all its outgoing communications to the server so the server can then forward them to their destination, which requires a tunnel program to handle. </span>
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='pptpserver'></a>PPTP Server</span>
  <div class='controlBoxContent'>
    Under Construction
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='openvpnserver'></a>OpenVPN Server</span>
  <div class='controlBoxContent'>
    Under Construction
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='gateways'></a>Gateways</span>
  <div class='controlBoxContent'>
    Default, Gateway By Device
    <span class='smallText'><br><br><b>Gateway-</b> A machine that serves internet; on most LANs this is the device the router's WAN connects to (like your modem). Sabai routers have the dual gateway feature which gives the user simple access to both their local ISP's gateway and their remote VPN's gateway.</span>
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='ping'></a>Ping</span>
  <div class='controlBoxContent'>
    Ping Address, Count, Size
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='trace'></a>Trace</span>
  <div class='controlBoxContent'>
    Trace Address, Hops, Wait
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='nslookup'></a>NS Lookup</span>
  <div class='controlBoxContent'>
    Domain, Lookup
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='route'></a>Route</span>
  <div class='controlBoxContent'>
    Routing table, Genmask,Flags, MSS, Window, IRTT, Interface
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='logs'></a>Logs</span>
  <div class='controlBoxContent'>
    Logs
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='firewall'></a>Firewall</span>
  <div class='controlBoxContent'>
    ICMP ping, Multicase, SYn Cookies, WAN route input
    <span class='smallText'><br><br><b>Firewall-</b>Firewall A program that checks traffic coming in and out and sorts through it accordingly. Â It's usually used for blocking unauthorized or suspicious connections. A common setup in routers is to allow all outgoing traffic (assuming devices on the network are not malicious) and any incoming traffic that is part of an established connection.</span>
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='portforwarding'></a>Port Forwarding</span>
  <div class='controlBoxContent'>
    Proto, Ports
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='dmz'></a>DMZ</span>
  <div class='controlBoxContent'>
    DMZ, Restriction
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='conntrack'></a>Conntrack</span>
  <div class='controlBoxContent'>
    Connections, TCP TImeout, UDP Timeout, Other timeouts, Tracking/NAT Helpers
  </div>
</div>
<div class='controlBox'>
  <span class='controlBoxTitle'><a href='#' name='upnp'></a>UPNP</span>
  <div class='controlBoxContent'>
    Settings, UPNP Ports
  </div>
</div>


<!-- <div class='pageTitle'>Network: WAN</div> -->
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->
<!-- 
<div class='controlBox'><span class='controlBoxTitle'>WAN</span>

	<div class='controlBoxContent'>
	<table class='controlTable'>
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
		 <tr<>td>IP</td><td><input id='wan_ip' name='wan_ip' /></td></tr>
		 <tr><td>Network Mask</td><td><input id='wan_mask' name='wan_mask' /></td></tr>
		 <tr><td>Gateway</td><td><input id='wan_gateway' name='wan_gateway' /></td></tr>
		</tbody>
		<tbody class='wan_type wan_type-dhcp wan_type-static'>
		 <tr><td>MTU</td><td><input id='wan_mtu' name='wan_mtu' /></td></tr>
		 <tr><td>MAC</td><td><input id='wan_mac' name='wan_mac' /></td></tr>
		</tbody>
	</table>
	</div>
</div> -->
<!-- 
<div class='controlBox'>
	<span class='controlBoxTitle'>DNS</span>
	<div class='controlBoxContent'>
		<table class='controlTable'>
			<tbody>
			<tr>
				<td>DNS Servers</td>
				<td><div><ul id='dns_servers'></ul></div></td>
				<td class="description">
					<div id='editableListDescription'>
						<span class ='xsmallText'>(These are the DNS servers the DHCP server will provide for devices also on the LAN)
						</span>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
<input type='button' value='Save' id='save'>
<pre id='testing'>
</pre>
 -->


<script type='text/ecmascript' src='php/etc.php?q=wan,dns'></script>
<script type='text/ecmascript' src='js/globalize.js'></script>
<script type='text/ecmascript' src='js/time.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

	$('#wan_mac').macspinner().macspinner('value',wan.mac);
	$('#wan_mtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
	$('#wan_gateway').ipspinner().ipspinner('value',wan.gateway);
	$('#wan_mask').maskspinner().maskspinner('value',wan.mask);
	$('#wan_ip').ipspinner().ipspinner('value',wan.ip);
	$('#wan_type').radioswitch({ value: wan.type, hasChildren: true });

	$('#dns_servers').editablelist({ list: dns.servers, fixed: true })

	$('#save').click( function() {
    var rawForm = $('#fe').serializeArray()
    var pForm = {}
    for(var i in rawForm){
      pForm[ rawForm[i].name ] = rawForm[i].value;
    }
    $('#testing').html( $('#fe').serializeArray()[0] )
    toServer(pForm, 'save');
  }); 

//$(function(){});
</script>
