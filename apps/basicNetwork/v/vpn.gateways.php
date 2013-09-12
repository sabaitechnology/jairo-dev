<div class='pageTitle'>VPN: Gateways</div>

<div class='controlBox'>
  <span class='controlBoxTitle'>Gateway Setup</span>

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

    <table id='list' class='listTable'></table>
      <input type='button' value='Save' onclick='saveGateway();'>
      <input type='button' value='Cancel' onclick='cancelGateway();'>
      <input type='button' value='Help' onclick='helpGateway();'> <br><br>
      <span class='smallText'>Each device connected to the network will be displayed in the device list above. For each device, the user has the option of assigning a gateway; Default, Local, VPN, or Accelerator within the device table. <a id="toggleDesc" onclick="toggleExplain();" href="#">(Show Description)</a> </span>

    <ul id="description" class="nobullets smallText noshow">
      <li><b>Default</b>: Any devices not assigned to Local, VPN, or Accelerator in the device list, will use the default as designated in the default assignment function at the top of the page. ('None' automatically assigns traffic to the routers current network state.)</li>
      <li><b>Local</b>: The internet connection provided by an ISP, i.e. a normal, non-VPN connection.</li>
      <li><b>VPN</b>: The connection through VPN, as set up on this router (either PPTP or OpenVPN).</li>
      <li><b>Accelerator</b>: A Sabai VPN Accelerator connection (a secondary device that handles VPN functions in place of the router. <a href="http://www.sabaitechnology.com/VPN-Accelerator-for-fast-VPN-routing-p/acc1st.htm">More Information</a>).</li>
      <li><br> </li>
      <li><b>MAC Address*</b>: The 'hardware' address of the device; this usually does not change and is somewhat unique.</li>
      <li><b>Address*</b>: The assigned Internet Protocol address of the device; this can regularly change, but will be made static if necessary to assign to a gateway.</li>
      <li><b>Name*</b>: The host name the device reports or the name assigned on the <a href="advanced-static.asp">Static IP page</a>; in the case of devices for which their is no reported hostname, one is assigned of the form i.interface@ipaddress.</li>
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
   { 'sTitle': 'MAC',   'mData':'mac' },
   { 'sTitle': 'Address', 'mData':'ip' },
   { 'sTitle': 'Name',    'mData':'hostname' },
   { 'sTitle': 'Gateway', 'mData': 'dlva', 'sClass': 'gatewayDrop'}],
  'fnInitComplete': function(){
       $('.gatewayDrop').editable(function(value, settings){
        var cPos = lt.fnGetPosition(this)
        lt.fnUpdate(value,cPos[0],cPos[1]);
        // lt.fnSetColumnVis( 0, false);
        //$('#demo').html( lt.fnGetPosition(this).join(',') );
        //$(this).editable()
        return value;
      },

      {
      'data': " {'Default':'Default', 'Local':'Local', 'VPN':'VPN', 'Accelerator':'Accelerator'}",
      'type':'select',
      'onblur':'submit',
      'event': 'dblclick'
      }
    )
   }
 });



$('#default_gateway').radioswitch({
 value: gateways.default
});

function toggleExplain(){

  if( $("#toggleDesc").text()=="(Show Description)" ) {
      $("#description").show();
      $("#toggleDesc").text("(Hide Description)");

  } else {
      $("#description").hide();
      $("#toggleDesc").text("(Show Description)");
  }
}

</script>