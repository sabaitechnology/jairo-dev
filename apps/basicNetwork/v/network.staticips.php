<div class='pageTitle'>Network: Static IPs</div>

<!--
 DHCP Leases
 ARP List
 Static Addresses?
-->

<div class='controlBox'><span class='controlBoxTitle'>Static Devices</span>
  <div class='controlBoxContent'>
    <table id='list' class='listTable'></table>
    <input type='button' value='Add' id='add'>
    <input type='button' value='Save' onclick='saveStaticList();'>
    <input type='button' value='Cancel' onclick='cancelStaticList();'>
  </div>
</div>

<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt;

lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'staticips',
  'sAjaxSource': 'php/bin.network.staticips.php',
  'aoColumns': [
   { 'sTitle': 'MAC',	'mData':'mac' },
   { 'sTitle': 'Address',	'mData':'ip' },
   { 'sTitle': 'Name',	'mData':'hostname' }
   ],
  'fnInitComplete': function(){
   $('td', this.fnGetNodes()).editable(function(value, settings){
     var cPos = lt.fnGetPosition(this)
     lt.fnUpdate(value,cPos[0],cPos[1]);
     return value;
    }, {
     'onblur':'submit',
     'event': 'dblclick',
     'placeholder' : '',
    });
  }
});

$('#add').click( function (e) {
    e.preventDefault();
     
    var aiNew = lt.fnAddData( 
      { 
      "MAC": '(Click to Enter)', 
      "Address": "(Click to Enter)", 
      "Name": "(Click to Enter)"
      }
    );

    var oSettings = lt.fnSettings();
    $('td', oSettings.aoData[ aiNew[0] ].nTr).editable(lt)
    // lt.fnInitComplete()
    var nRow = lt.fnGetNodes( aiNew[0] );
    // editRow( lt, nRow );
    // nEditing = nRow;
} );


</script>
