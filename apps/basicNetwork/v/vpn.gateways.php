<div class='pageTitle'>VPN: Gateways</div>

<!-- TODO: SHow dropdown always-->

<div class='controlBox'><span class='controlBoxTitle'>Gateway Setup</span>
  <div class='controlBoxContent'>
    <table class='controlTable'><tbody>
     <tr><td>Default Gateway: </td><td>
      <select id='defaultGateway' name='defaultGateway' class='radioSwitchElement'>
       <option value='none'>None</option>
       <option value='local'>Local</option>
       <option value='vpn'>VPN</option>
       <option value='accelerator'>Accelerator</option>
      </select>
     </td></tr>
    </tbody></table>
    
    <br><br>
    <span style='font-style:italic'>*Gateway By Device (optional):</span>
    <br><br>
    
    <table id='list' class='listTable clickable'></table>
    <input type='button' value='Save' onclick='saveGateway();'>
    <input type='button' value='Cancel' onclick='cancelGateway();'>
    <span class='xsmallText'>(Double-Click Gateway Fields to Edit)</span>

    <br><br>
    <span class='smallText'>Each device connected to the network will be displayed in the device list above. For each device, the user has the option of assigning a gateway; Default, Local, VPN, or Accelerator within the device table. 
      <a id="toggleDesc" onclick="toggleExplain();" href="#">(Show Description)</a> 
      <br>
      <ul id="description" class="nobullets noshow">
        <li><b>Default</b>: Any devices not assigned to Local, VPN, or Accelerator in the device list, will use the default as designated in the default assignment function at the top of the page. ('None' automatically assigns traffic to the routers current network state.)</li>
        <li><b>Local</b>: The internet connection provided by an ISP, i.e. a normal, non-VPN connection.</li>
        <li><b>VPN</b>: The connection through VPN, as set up on this router (either PPTP or OpenVPN).</li>
        <li><b>Accelerator</b>: A Sabai VPN Accelerator connection (a secondary device that handles VPN functions in place of the router. <a href="http://www.sabaitechnology.com/VPN-Accelerator-for-fast-VPN-routing-p/acc1st.htm">More Information</a>).</li>
        <li><br> </li>
        <li><b>MAC Address*</b>: The 'hardware' address of the device; this usually does not change and is somewhat unique.</li>
        <li><b>Address*</b>: The assigned Internet Protocol address of the device; this can regularly change, but will be made static if necessary to assign to a gateway.</li>
        <li><b>Name*</b>: The host name the device reports or the name assigned on the 
          <a href="advanced-static.asp">Static IP page</a>
          ; in the case of devices for which their is no reported hostname, one is assigned of the form i.interface@ipaddress.</li>
      </ul>
      <br>
      See also: <a href="http://localjen/apps/basicNetwork/?panel=wireless&section=macfilter">MAC Filter</a>
    </span>

  </div>
</div>

<script type='text/ecmascript' src='php/etc.php?q=gateways'></script>
<script type='text/ecmascript'>

  var lt=  $('#list').dataTable({
    'bPaginate': false,
    'bInfo': false,
    'bFilter': false,
    'sAjaxDataProp': 'gateway',
    'aaData': gateways.rules,
    'aoColumns': [
    { 'sTitle': 'MAC',      'mData':'mac' },
    { 'sTitle': 'Address',  'mData':'ip' },
    { 'sTitle': 'Name',     'mData':'hostname' },
    { 'sTitle': '*Gateway', 'mData':'gateway', 'sClass': 'gatewayDrop'}],
    
    'fnInitComplete': function(){
      $('.gatewayDrop').editable(function(value, settings){
        var cPos = lt.fnGetPosition(this)
        lt.fnUpdate(value,cPos[0],cPos[1]);
        return value;
      },

      {
      'data': " {'Default':'Default', 'Local':'Local', 'VPN':'VPN', 'Accelerator':'Accelerator'}",
      'type':'select',
      'onblur':'submit',
      'event': 'dblclick'
      })
    }
  });

  function saveGateway(){
    toServer('Save this.'); 
  };

  $('#defaultGateway').radioswitch({ value: gateways.default });

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