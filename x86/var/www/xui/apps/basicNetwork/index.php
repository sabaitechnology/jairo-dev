<!DOCTYPE html><html><head>
<title id='mainTitle'>Sabai x86</title>
<link rel='stylesheet' type='text/css' href='/libs/jquery-ui.min.css'>
<link rel='stylesheet' type='text/css' href='css/main.css'>

<script type='text/ecmascript' src='/libs/jquery-1.9.1.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>
<script src="/libs/jquery.mousewheel.js"></script>
<!-- script type='text/ecmascript' src='/libs/xui.js'></script -->
<script type='text/ecmascript' src='js/math.js'></script>
<script type='text/ecmascript' src='js/widgets.js'></script>
<script type='text/ecmascript' src='js/main.js'></script>
<script type='text/ecmascript'>
<?php
 $panel = array_key_exists('panel',$_REQUEST)?preg_replace('/[^a-z\d]/i', '', $_REQUEST['panel']):'network';
 $section = array_key_exists('section',$_REQUEST)?preg_replace('/[^a-z\d]/i', '', $_REQUEST['section']):'wan';
 $page = "v/$panel.$section.php";
 $page = file_exists($page)?$page:'v/lorem.php';
 echo "var panel='$panel'; var section='$section';\n";
?>
</script>
</head><body>

<div id='backdrop'>

 <div id='menuContainer'>
  <img id='menuHeader' src='img/menuHeader.png'>
  <ul id='superMenu'>

   <li>
    <a id='network' class='superMenuLink button'>Network</a>
    <ul id='networkSubMenu' class='subMenu'>
     <li><a id='network_wan' href='?panel=network&section=wan' class='subMenuLink button'>WAN</a></li>
     <li><a id='network_lan' href='?panel=network&section=lan' class='subMenuLink button'>LAN</a></li>
     <li><a id='network_devicelist' href='?panel=network&section=devicelist' class='subMenuLink button'>Device List</a></li>
     <li><a id='network_staticip' href='?panel=network&section=staticip' class='subMenuLink button'>Static IPs</a></li>
    </ul>
   </li>

   <li>
    <a id='wireless' class='superMenuLink button'>Wireless</a>
    <ul id='wirelessSubMenu' class='subMenu'>
     <li><a id='wireless_wl0' href='?panel=wireless&section=wl0' class='subMenuLink button'>WL0</a></li>
     <li><a id='wireless_survey' href='?panel=wireless&section=survey' class='subMenuLink button'>Survey</a></li>
     <li><a id='wireless_macfilter' href='?panel=wireless&section=macfilter' class='subMenuLink button'>MAC Filter</a></li>
    </ul>
   </li>

   <li>
    <a id='vpn' class='superMenuLink button'>VPN</a>
    <ul id='vpnSubMenu' class='subMenu'>
     <li><a id='vpn_pptp' href='?panel=vpn&section=pptp' class='subMenuLink button'>PPTP</a></li>
     <li><a id='vpn_openvpn' href='?panel=vpn&section=openvpn' class='subMenuLink button'>OpenVPN</a></li>
     <li><a id='vpn_l2tp' href='?panel=vpn&section=l2tp' class='subMenuLink button'>L2TP</a></li>
     <li><a id='vpn_ipsec' href='?panel=vpn&section=ipsec' class='subMenuLink button'>IPSEC</a></li>
     <li><a id='vpn_pptpserver' href='?panel=vpn&section=pptpserver' class='subMenuLink button'>PPTP Server</a></li>
     <li><a id='vpn_openvpnserver' href='?panel=vpn&section=openvpnserver' class='subMenuLink button'>OpenVPN Server</a></li>
     <li><a id='vpn_gateways' href='?panel=vpn&section=gateways' class='subMenuLink button'>Gateways</a></li>
    </ul>
   </li>

   <li>
    <a id='diagnostics' class='superMenuLink button'>Diagnostics</a>
    <ul id='diagnosticsSubMenu' class='subMenu'>
     <li><a id='diagnostics_ping' href='?panel=diagnostics&section=ping' class='subMenuLink button'>Ping</a></li>
     <li><a id='diagnostics_trace' href='?panel=diagnostics&section=trace' class='subMenuLink button'>Trace</a></li>
     <li><a id='diagnostics_nslookup' href='?panel=diagnostics&section=nslookup' class='subMenuLink button'>NS Lookup</a></li>
     <li><a id='diagnostics_route' href='?panel=diagnostics&section=route' class='subMenuLink button'>Route</a></li>
     <li><a id='diagnostics_logs' href='?panel=diagnostics&section=logs' class='subMenuLink button'>Logs</a></li>
    </ul>
   </li>

   <li>
    <a id='security' class='superMenuLink button'>Security</a>
    <ul id='securitySubMenu' class='subMenu'>
     <li><a id='security_firewall' href='?panel=security&section=firewall' class='subMenuLink button'>Firewall</a></li>
     <li><a id='security_portforwarding' href='?panel=security&section=portforwarding' class='subMenuLink button'>Port Forwarding</a></li>
     <li><a id='security_dmz' href='?panel=security&section=dmz' class='subMenuLink button'>DMZ</a></li>
     <li><a id='security_conntrack' href='?panel=security&section=conntrack' class='subMenuLink button'>Conntrack</a></li>
     <li><a id='security_upnp' href='?panel=security&section=upnp' class='subMenuLink button'>UPnP</a></li>
    </ul>
   </li>

   <li>
    <a id='about' href='?panel=about' class='superMenuLink button'>About</a>
   </li>


  </ul>
 </div>

 <div id='panelContainer'>
  <div id='panel'>

<?php include($page); ?>

  </div>
 </div>
</div>

</body></html>
