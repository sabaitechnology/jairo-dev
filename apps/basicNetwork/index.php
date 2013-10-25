<!DOCTYPE html><html><head>
<title id='mainTitle'>Sabai Jai Ro</title>
<link rel='stylesheet' type='text/css' href='/libs/jquery-ui.min.css'>
<link rel='stylesheet' type='text/css' href='/libs/jquery.ui.menu.css'>
<link rel='stylesheet' type='text/css' href='css/main.css'>


<script type='text/ecmascript' src='/libs/jquery-1.9.1.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>
<script src="/libs/jquery.mousewheel.js"></script>

<!-- noty stuff  -->
<script type="text/javascript" src="/libs/jquery.noty.js"></script>
<script type="text/javascript" src="/libs/top.js"></script>
<script type="text/javascript" src="/libs/bottomRight.js"></script>
<script type="text/javascript" src="/libs/default.js"></script>

<!-- script type='text/ecmascript' src='/libs/jai.js'></script -->
<script type='text/ecmascript' src='js/math.js'></script>
<script type='text/ecmascript' src='js/widgets.js'></script>
<script type='text/ecmascript' src='js/main.js'></script>
<script type='text/ecmascript'>

//noty settings 
$.noty.defaults = {
    layout: 'bottomRight',
    theme: 'defaultTheme',
    type: 'alert',
    text: '',
    dismissQueue: true, // If you want to use queue feature set this true
    template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
    animation: {
        open: {height: 'toggle'},
        close: {height: 'toggle'},
        easing: 'swing',
        speed: 500 // opening & closing animation speed
    },
    timeout: 1000, // delay for closing event. Set false for sticky notifications
    force: false, // adds notification to the beginning of queue when set to true
    modal: false,
    maxVisible: 5, // you can set max visible notification for dismissQueue true option
    closeWith: ['click'], // ['click', 'button', 'hover']
    callback: {
        onShow: function() {},
        afterShow: function() {},
        onClose: function() {},
        afterClose: function() {}
    },
    buttons: false // an array of buttons
};


//help function
 $(function() {

  // run the currently selected effect
  function runEffect() {
    var selectedEffect = "slide";
    var options = {direction:'right'};
    // run the effect
    $( "#helpButton" ).hide();
    $( "#effect" ).toggle( selectedEffect, options, 500 );
  };

  // set effect from select menu value
  $( "#helpButton" ).click(function() {
    runEffect();
    return false;
    });

   $( "#closeHelp" ).click(function() {
    runEffect();
    $( "#helpButton").show('slow');
    return false;
    });

});

<?php
 $panel = array_key_exists('panel',$_REQUEST)?preg_replace('/[^a-z\d]/i', '', $_REQUEST['panel']):'network';
 $section = array_key_exists('section',$_REQUEST)?preg_replace('/[^a-z\d]/i', '', $_REQUEST['section']):'wan';
 $page = "v/$panel.$section.php";
 $page = file_exists($page)?$page:'v/lorem.php';
 $titleInfo = array (
  'wan' => 'WAN Help',
  'lan' => 'LAN Help',
  'time' => 'Time Help',
  'devicelist' => 'Device List Help',
  'staticips' => 'Static IP Help',
  'radio' => 'Radio Help',
  'survey' => 'Survey Help',
  'macfilter' => 'MAC Filter Help',
  'pptp' => 'PPTP Help',
  'openvpn' => 'OpenVPN Help',
  'l2tp' => 'L2TP Help',
  'ipsec' => 'IPSEC Help',
  'pptpserver' => 'PPTP Server Help',
  'openvpnserver' => 'OpenVPN Server Help',
  'gateways' => 'Gateways Help',
  'ping' => 'Ping Help',
  'trace' => 'Trace Help',
  'nslookup' => 'NS Lookup Help',
  'route' => 'Route Help',
  'firewall' => 'Firewall Help',
  'portforwarding' => 'Port Forwarding Help',
  'dmz' => 'DMZ Help',
  'conntrack' => 'Conntrack Help',
  'upnp' => 'UPNP Help',
  'about' => 'About Help'
  );

$title= $titleInfo[$section];

 $helpInfo = array (
  'wan' => 'WAN Help',
  'lan' => 'LAN Help',
  'time' => 'Time Help',
  'devicelist' => 'Device List Help',
  'staticips' => 'Static IP Help',
  'radio' => 'Radio Help',
  'survey' => 'Survey Help',
  'macfilter' => 'MAC Filter Help',
  'pptp' => 'PPTP Help',
  'openvpn' => 'OpenVPN Help',
  'l2tp' => 'L2TP Help',
  'ipsec' => 'IPSEC Help',
  'pptpserver' => 'PPTP Server Help',
  'openvpnserver' => 'OpenVPN Server Help',
  'gateways' => 'Gateways Help',
  'ping' => 'Ping Help',
  'trace' => 'Trace Help',
  'nslookup' => 'NS Lookup Help',
  'route' => 'Route Help',
  'firewall' => 'Firewall Help',
  'portforwarding' => 'Port Forwarding Help',
  'dmz' => 'DMZ Help',
  'conntrack' => 'Conntrack Help',
  'upnp' => 'UPNP Help',
  'about' => 'About Help'
  );

 $help = $helpInfo[$section];

 echo "var panel='$panel'; var section='$section';";
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
     <li><a id='network_time' href='?panel=network&section=time' class='subMenuLink button'>Time</a></li>
     <li><a id='network_devicelist' href='?panel=network&section=devicelist' class='subMenuLink button'>Device List</a></li>
     <li><a id='network_staticips' href='?panel=network&section=staticips' class='subMenuLink button'>Static IPs</a></li>
    </ul>
   </li>

   <li>
    <a id='wireless' class='superMenuLink button'>Wireless</a>
    <ul id='wirelessSubMenu' class='subMenu'>
     <li><a id='wireless_radio' href='?panel=wireless&section=radio' class='subMenuLink button'>Radio</a></li>
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

   <li>
    <a id='help' href='?panel=help' class='superMenuLink button'>Help</a>
   </li>


  </ul>
 </div>

 <div id='panelContainer'>
  <div id='panel'>
    <form id='fe'>


    <?php echo "<img id='helpButton' src='img/help.png'><div class='toggler'><div id='effect' class='ui-widget-content ui-corner-al'><a href='#' id='closeHelp' class='xsmallText fright'>Close</a><h4>".$help."</h4>Display Inline Help <input name='inlineHelp' id='inlineHelp' type='checkbox' checked='checked'><br><br><span style='text-decoration: underline'>Links:</span><br><a id='goToHelp' href='http://localjen/apps/basicNetwork/?panel=help&section=wan#".$section."'>Manual Page</a><br><a id='goToHelp' href='#'>Wiki Page</a></div></div>"; include($page); ?>

    </form>

  </div>
 </div>
</div>

</body></html>
