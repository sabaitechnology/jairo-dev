<div class='pageTitle'>VPN: Gateways</div>

<!-- TODO: 
 set default selection as default dropdown value
-->

<div class='controlBox'><span class='controlBoxTitle'>Gateway Setup</span>
  <div class='controlBoxContent'>
    <table class='controlTable'>
    <tbody>
     <tr><td>Select Default</td><td>
      <select id='default_gateway' name='default_gateway' class='radioSwitchElement'>
       <option value='none'>None</option>
       <option value='local'>Local</option>
       <option value='vpn'>VPN</option>
       <option value='accelerator'>Accelerator</option>
      </select>
     </td></tr>
    </tbody>
    </table>
    <br>



     
  <table id='list' class='listTable'></table>
  <input type='button' value='Save' onclick='composeStaticList();'>
  <input type='button' value='Cancel' onclick='composeStaticList();'>
  <input type='button' value='Help' onclick='composeStaticList();'> <br><br>
  <span class='smallText'>Each device connected to the network will be displayed in the device list above. For each device, the user has the option of assigning a gateway; (D)efault, (L)ocal), (V)PN, or (A)ccelerator within the device table. <a onclick="toggleExplain();" href="#">(<span id="toggleDesc">Hide</span> Description)</a> </span>
  
  <ul class="nobullets smallText">
    <li><b>(D) Default</b>: Any devices not assigned to Local, VPN, or Accelerator in the device list, will use the default as designated in the default assignment function at the top of the page. ('None' automatically assigns traffic to the routers current network state.)</li>
    <li><b>(L) Local</b>: The internet connection provided by an ISP, i.e. a normal, non-VPN connection.</li>
    <li><b>(V) VPN</b>: The connection through VPN, as set up on this router (either PPTP or OpenVPN).</li>
    <li><b>(A) Accelerator</b>: A Sabai VPN Accelerator connection (a secondary device that handles VPN functions in place of the router. <a href="http://www.sabaitechnology.com/VPN-Accelerator-for-fast-VPN-routing-p/acc1st.htm">More Information</a>).</li>
    <li><br> </li>
    <li><b>Assign All</b>: Places every listed device on the gateway for that column.</li>
    <li><b>MAC Address*</b>: The 'hardware' address of the device; this usually does not change and is somewhat unique.</li>
    <li><b>IP Address*</b>: The assigned Internet Protocol address of the device; this can regularly change, but will be made static if necessary to assign to a gateway.</li>
    <li><b>Name*</b>: The host name the device reports or the name assigned on the <a href="advanced-static.asp">Static IP page</a>; in the case of devices for which their is no reported hostname, one is assigned of the form i.interface@ipaddress.</li>
    <li><b>*</b> This information can be edited on the <a href="advanced-static.asp">Static IP page</a>.</li>
  </ul>

  </div>

</div>



<script type='text/ecmascript' src='php/bin.etc.php?q=gateways'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt=  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'gateway',
  'sAjaxSource': 'php/bin.vpn.gateway.php',
  'aoColumns': [
   { 'sTitle': 'MAC',		'mData':'mac' },
   { 'sTitle': 'Address',	'mData':'ip' },
   { 'sTitle': 'Name',		'mData':'hostname' },
   { 'sTitle': 'Gateway', 'mData': 'dlva'   }

  ]
 });

$('#default_gateway').radioswitch({
 value: gateways.default
});

</script>
