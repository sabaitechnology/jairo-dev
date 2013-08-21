<div class='pageTitle'>Security: Port Forwarding</div>


<div class='controlBox'><span class='controlBoxTitle'>Port Forwarding</span>
  <div class='controlBoxContent'>

  <table id='list' class='listTable'>
  </table>
  <input type='button' value='Save' onclick='composeStaticList();'>
  <input type='button' value='Cancel' onclick='composeStaticList();'>
  <input type='button' value='Help' onclick='composeStaticList();'> <br>

  <ul class='nobullets'>
  <span class='xsmallText'>
    <li><b>Proto - </b>Which protocol (tcp or udp) to forward.</li>
    <li><b>VPN - </b>Forward ports through the normal internet connection (WAN) or through the tunnel (VPN), or both. Note that the Gateways feature may result in may result in undefined behavior when devices routed through an interface have ports forwarded through a different interface. Additionally, ports will only be forwarded through the VPN when the VPN service is active. <li>
    <li><b>Src Address (optional) - </b>Forward only if from this address. Ex: "1.2.3.4", "1.2.3.4 - 2.3.4.5", "1.2.3.0/24", "me.example.com". </li>
    <li><b>Ext Ports - </b>The port(s) to be forwarded, as seen from the WAN. Ex: "2345", "200,300", "200-300,400". </li>
    <li><b>Int Port -</b> The destination port inside the LAN. Only one port per entry is supported.</li>
    <li><b>Int Address - </b>The destination address inside the LAN. </li>
  </span>
  </ul>



  </div>

</div>



<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'sAjaxDataProp': 'portforwarding',
  'sAjaxSource': 'php/bin.security.portforwarding.php',
  'aoColumns': [
   { 'sTitle': 'On',		'mData':'On' },
   { 'sTitle': 'Proto',	'mData':'Proto' },
   { 'sTitle': 'VPN',		'mData':'VPN' },
   { 'sTitle': 'Src Address', 'mData':'Src Address'  },
   { 'sTitle': 'Ext Port',  'mData':'Ext Port' },
   { 'sTitle': 'Int Port',   'mData':'Int Port' },
   { 'sTitle': 'Int Address', 'mData':'Int Address'  },
   { 'sTitle': 'Description', 'mData':'Description'  }

  ]
  
});
</script>
