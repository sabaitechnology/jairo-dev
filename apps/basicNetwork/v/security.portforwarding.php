<div class='pageTitle'>Security: Port Forwarding</div>

<div class='controlBox'>
  <span class='controlBoxTitle'>Port Forwarding</span>
  <div class='controlBoxContent'> 
    
    <table id='list' class='listTable clickable'></table>
    
    <input type='button' value='Add' id='add'>
    <input type='button' value='Save' onclick='saveGateway();'>
    <input type='button' value='Cancel' onclick='cancelGateway();'>

    <div class="smallText">
      <br><b>Proto</b>- Which protocol (tcp or udp) to forward. </li>
      <br><b>VPN</b> - Forward ports through the normal internet connection (WAN) or through the tunnel (VPN), or both. Note that the Gateways feature may result in may result in undefined behavior when devices routed through an interface have ports forwarded through a different interface. Additionally, ports will only be forwarded through the VPN when the VPN service is active. </li>
      <br><b>Src Address</b>(optional) - Forward only if from this address. Ex: "1.2.3.4", "1.2.3.4 - 2.3.4.5", "1.2.3.0/24", "me.example.com". </li>
      <br><b>Ext Ports</b> - The port(s) to be forwarded, as seen from the WAN. Ex: "2345", "200,300", "200-300,400". </li>
      <br><b>Int Port</b>- The destination port inside the LAN. Only one port per entry is supported. </li>
      <br><b>Int Address</b>- The destination address inside the LAN. </li>
    </div>

  <div>
</div>


<script type='text/ecmaascript'src='/libs/jquery.jeditable.checkbox.js'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

  var lt =  $('#list').dataTable({
    'bPaginate': false,
    'bInfo': false,
    "bProcessing": true,
    'sAjaxDataProp': 'portforwarding',
    'sAjaxSource': 'php/bin.security.portforwarding.php',
    'aoColumns': [
      { 'sTitle': 'On/Off',       'mData':'On',         'sClass': 'onDrop'},  
      { 'sTitle': 'Proto',        'mData':'Proto',      'sClass':'protoDrop' },
      { 'sTitle': 'VPN',          'mData':'VPN',        'sClass':'vpnDrop' },
      { 'sTitle': 'Src Address',  'mData':'Src Address','sClass':'plainText'  },
      { 'sTitle': 'Ext Port',     'mData':'Ext Port',   'sClass':'plainText'   }, 
      { 'sTitle': 'Int Port',     'mData':'Int Port',   'sClass':'plainText' },
      { 'sTitle': 'Int Address',  'mData':'Int Address','sClass':'plainText'  },
      { 'sTitle': 'Description',  'mData':'Description','sClass':'plainText'  }],

    'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
      $(nRow).find('.plainText').editable(
        function(value, settings){ return value; },
        {
          'onblur':'submit',
          'event': 'dblclick',
          'placeholder' : 'Click to edit',
        }
      );

      $(nRow).find('.onDrop').editable(
        function(value, settings){ return value; },
        {
        'data': " {'On':'On','Off':'Off'}",
        'type':'select',
        'onblur':'submit',
        'event': 'dblclick'
        }
      );

      $(nRow).find('.protoDrop').editable(
        function(value, settings){ return value; },
        {
        'data': " {'UDP':'UDP','TCP':'TCP', 'Both':'Both'}",
        'type':'select',
        'onblur':'submit',
        'event': 'dblclick'
        }
      );

      $(nRow).find('.vpnDrop').editable(
        function(value, settings){ return value; },
        {
        'data': " {'LAN':'LAN', 'WAN':'WAN',}",
        'type':'select',
        'onblur':'submit',
        'event': 'dblclick'
        }
      );

      $('td', this.fnGetNodes()).editable(
        function(value, settings){ return value; },
        {
         'onblur':'submit',
         'event': 'dblclick',
         'placeholder' : '',
        }
      );

    } /* end fnRowCallback*/
  }) /* end datatable*/


  $('#add').click( function (e) {
    e.preventDefault();
    lt.fnAddData(
      { 
      "On": null, 
      "Proto": null,
      "VPN": null,
      "Src Address": null,
      "Ext Port": null,
      "Int Port": null,
      "Int Address": null,
      "Description": null 
      }
    );
  });

  function saveGateway(){
    toServer('Save this.');
  };

  function toggleExplain(){

    if( $("#toggleDesc").text()=="Show Description") {
      $("#description").show();
      $("#toggleDesc").text("Hide Description");
    } else {
      $("#description").hide();
      $("#toggleDesc").text("Show Description");
    }
  }

</script>