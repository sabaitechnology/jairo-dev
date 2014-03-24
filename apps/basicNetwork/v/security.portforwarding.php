<div class='pageTitle'>Security: Port Forwarding</div>


<!-- TODO: Cancel Buttn -->

<div class='controlBox'>
  <span class='controlBoxTitle'>Port Forwarding</span>
  <div class='controlBoxContent' id='portforwarding'> 

  </div>
  <div class="controlBoxContent smallText">
    <b>Proto</b>- Which protocol (tcp or udp) to forward. </li>
    <br><b>VPN</b> - Forward ports through the normal internet connection (WAN) or through the tunnel (VPN), or both. Note that the Gateways feature may result in may result in undefined behavior when devices routed through an interface have ports forwarded through a different interface. Additionally, ports will only be forwarded through the VPN when the VPN service is active. </li>
    <br><b>Src Address</b>(optional) - Forward only if from this address. Ex: "1.2.3.4", "1.2.3.4 - 2.3.4.5", "1.2.3.0/24", "me.example.com". </li>
    <br><b>Ext Ports</b> - The port(s) to be forwarded, as seen from the WAN. Ex: "2345", "200,300", "200-300,400". </li>
    <br><b>Int Port</b>- The destination port inside the LAN. Only one port per entry is supported. </li>
    <br><b>Int Address</b>- The destination address inside the LAN. </li>
  </div>
</div>

<script type='text/ecmascript' src='php/etc.php?q=portforwarding'></script>
<script type='text/ecmascript'>

$.widget("jai.portforwarding", {

  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    

    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table'))
      .addClass("listTable")
      .prop("id","list") 
    )
    .append( $(document.createElement('input'))
     .prop("type", "button")
     .prop("id", "add")
     .prop("value", "Add")
    )
    .append( $(document.createElement('input'))
     .prop("type", "button")
     .prop("id", "save")
     .prop("value", "Save")
     .prop("onClick", "saveStatic();")
    )
    .append( $(document.createElement('input'))
     .prop("type", "button")
     .prop("id", "cancel")
     .prop("value", "Cancel")
     .prop("onClick", "cancelStatic();")
    )
    .append( $(document.createElement('span'))
     .addClass('xsmallText')
     .html("(Double-Click Fields to Edit)")
    )
    
    
    var lt =  $('#list').dataTable({
      'bPaginate': false,
      'bInfo': false,
      "bProcessing": true,
      'aaData': portforwarding,
      'aoColumns': [
        { 'sTitle': 'On/Off',       'mData':'on',         'sClass': 'onDrop'},  
        { 'sTitle': 'Proto',        'mData':'protocol',   'sClass':'protoDrop' },
        { 'sTitle': 'VPN',          'mData':'gateway',    'sClass':'vpnDrop' },
        { 'sTitle': 'Src Address',  'mData':'src',        'sClass':'plainText'  },
        { 'sTitle': 'Ext Port',     'mData':'ext',        'sClass':'plainText'   }, 
        { 'sTitle': 'Int Port',     'mData':'int',        'sClass':'plainText' },
        { 'sTitle': 'Int Address',  'mData':'address',    'sClass':'plainText'  },
        { 'sTitle': 'Description',  'mData':'description','sClass':'plainText'  }
      ],

      'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
        $(nRow).find('.plainText').editable(
          function(value, settings){ return value; },
          {
            'onblur':'submit',
            'event': 'dblclick',
            'placeholder' : 'Click to edit'
          }
        );

        $(nRow).find('.onDrop').editable(
          function(value, settings){ return value; },
          {
          'data': " {'on':'On','off':'Off'}",
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
          'data': " {'LAN':'LAN', 'WAN':'WAN'}",
          'type':'select',
          'onblur':'submit',
          'event': 'dblclick'
          }
        );

      } /* end fnRowCallback*/
    }) /* end datatable*/

  $('#add').click( function (e) {
    e.preventDefault();
    lt.fnAddData(
      { 
      "on": null, 
      "protocol": null,
      "gateway": null,
      "src": null,
      "ext": null,
      "int": null,
      "address": null,
      "description": null 
      }
    );
  });

  this._super();
  }
 });

$(function(){
  //instatiate widgets on document ready
  $('#portforwarding').portforwarding();
})

function saveGateway(){
  toServer('Save this.');
};

// function toggleExplain(){

//   $("#description").toggle();
//   if( $("#toggleDesc").text()=="Show Description") {
//     $("#description").show();
//     $("#toggleDesc").text("Hide Description");
//   } else {
//     $("#description").hide();
//     $("#toggleDesc").text("Show Description");
//   }
// }

</script>