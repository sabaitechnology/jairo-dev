<div class='pageTitle'>Security: Port Forwarding</div>

<div class='controlBox'>
  <span class='controlBoxTitle'>Port Forwarding</span>

  <div class='controlBoxContent'> 

      <table id='list' class='listTable'></table>
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
      { 'sTitle': 'On/Off', 'mData':'On', 'sClass': 'onDrop'},  
      { 'sTitle': 'Proto',  'mData':'Proto', 'sClass':'protoDrop' },
      { 'sTitle': 'VPN',    'mData':'VPN', 'sClass':'vpnDrop' },
      { 'sTitle': 'Src Address', 'mData':'Src Address'  },
      { 'sTitle': 'Ext Port',  'mData':'Ext Port' },
      { 'sTitle': 'Int Port',   'mData':'Int Port' },
      { 'sTitle': 'Int Address', 'mData':'Int Address'  },
      { 'sTitle': 'Description', 'mData':'Description'  }],

    'fnInitComplete': function(){
        // currently the first "ok" does not submit - when this is fixed can remove cancel & submit buttons
        
        $('.onDrop').editable(function(value, settings){
            var cPos = lt.fnGetPosition(this)
            lt.fnUpdate(value,cPos[0],cPos[1]);
            // lt.fnSetColumnVis( 0, false);
            //$('#demo').html( lt.fnGetPosition(this).join(',') );
            //$(this).editable()
            return value;
          },

          {
          'data': " {'On':'On','Off':'Off'}",
          'type':'select',
          'onblur':'submit',
          'event': 'dblclick'
          }
        ),

        $('.protoDrop').editable(function(value, settings){
            var cPos = lt.fnGetPosition(this)
            lt.fnUpdate(value,cPos[0],cPos[1]);
            // lt.fnSetColumnVis( 0, false);
            //$('#demo').html( lt.fnGetPosition(this).join(',') );
            //$(this).editable()
            return value;
          },

          {
          'data': " {'UDP':'UDP','TCP':'TCP', 'Both':'Both'}",
          'type':'select',
          'onblur':'submit',
          'event': 'dblclick'
          }
        ),

        $('.vpnDrop').editable(function(value, settings){
            var cPos = lt.fnGetPosition(this)
            lt.fnUpdate(value,cPos[0],cPos[1]);
            // lt.fnSetColumnVis( 0, false);
            //$('#demo').html( lt.fnGetPosition(this).join(',') );
            //$(this).editable()
            return value;
          },

          {
          'data': " {'LAN':'LAN', 'WAN':'WAN',}",
          'type':'select',
          'onblur':'submit',
          'event': 'dblclick'
          }
        ),


        $('td', this.fnGetNodes()).editable(function(value, settings){
            var cPos = lt.fnGetPosition(this)
            lt.fnUpdate(value,cPos[0],cPos[1]);
            // lt.fnSetColumnVis( 0, false);
            //$('#demo').html( lt.fnGetPosition(this).join(',') );
            //$(this).editable()
            return value;
          },

          {
           'onblur':'submit',
           'event': 'dblclick',
           'placeholder' : '',
          }
        )

    }


 }) 

// var nEditing = null;
     
//     $('#list a.edit').on('click', function (e) {
//         e.preventDefault();
         
//         /* Get the row as a parent of the link that was clicked on */
//         var nRow = $(this).parents('tr')[0];
         
//         if ( nEditing !== null && nEditing != nRow ) {
//             /* A different row is being edited - the edit should be cancelled and this row edited */
//             restoreRow( lt, nEditing );
//             editRow( lt, nRow );
//             nEditing = nRow;
//         }
//         else if ( nEditing == nRow && this.innerHTML == "Save" ) {
//             /* This row is being edited and should be saved */
//             saveRow( lt, nEditing );
//             nEditing = null;
//         }
//         else {
//             /* No row currently being edited */
//             editRow( lt, nRow );
//             nEditing = nRow;
//         }
//     } );



// function saveRow ( lt, nRow )
// {
//     var jqInputs = $('input', nRow);
//     lt.fnUpdate( jqInputs[0].value, nRow, 0, false );
//     lt.fnUpdate( jqInputs[1].value, nRow, 1, false );
//     lt.fnUpdate( jqInputs[2].value, nRow, 2, false );
//     lt.fnUpdate( jqInputs[3].value, nRow, 3, false );
//     lt.fnUpdate( jqInputs[4].value, nRow, 4, false );
//     lt.fnUpdate( '<a class="edit" href="">Edit</a>', nRow, 5, false );
//     lt.fnDraw();
// }

$('#add').click( function (e) {
    e.preventDefault();
     
    var aiNew = lt.fnAddData( 
    { 
    "On": '(Click to Enter)', 
    "Proto": "(Click to Enter)", 
    "VPN": "(Click to Enter)", 
    "Src Address": "(Click to Enter)", 
    "Ext Port": "(Click to Enter)", 
    "Int Port": "(Click to Enter)", 
    "Int Address": "(Click to Enter)", 
    "Description": "(Click to Enter)" 
  }
);

    var oSettings = lt.fnSettings();
    $('td', oSettings.aoData[ aiNew[0] ].nTr).editable(lt)
    // lt.fnInitComplete()
    var nRow = lt.fnGetNodes( aiNew[0] );
    // editRow( lt, nRow );
    // nEditing = nRow;
} );




function editRow ( tr, nRow )
{
    var aData = tr.fnGetData(nRow);
    var jqTds = $('>td', nRow);
    jqTds[0].innerHTML = '<input value="'+aData[0]+'" type="text">';
    jqTds[1].innerHTML = '<input value="'+aData[1]+'" type="text">';
    jqTds[2].innerHTML = '<input value="'+aData[2]+'" type="text">';
    jqTds[3].innerHTML = '<input value="'+aData[3]+'" type="text">';
    jqTds[4].innerHTML = '<input value="'+aData[4]+'" type="text">';
    jqTds[5].innerHTML = '<input value="'+aData[5]+'" type="text">';
    jqTds[6].innerHTML = '<input value="'+aData[6]+'" type="text">';
    jqTds[7].innerHTML = '<input value="'+aData[7]+'" type="text">';
}


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