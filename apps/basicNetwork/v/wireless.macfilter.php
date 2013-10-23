<div class='pageTitle'>Wireless: MAC Filter</div>

<div class='controlBox'><span class='controlBoxTitle'>WL0</span>
	<div class='controlBoxContent'>
		<table id='list' class='listTable clickable'></table>
      <input type='button' value='Add' id='add'>
      <input type='button' value='Save' onclick='saveMACg();'>
      <input type='button' value='Cancel' onclick='cancelMAC();'>
	</div>
</div>


<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'macfilter',
  'sAjaxSource': 'php/bin.wireless.macfilter.php',
  'aoColumns': [
     { 'sTitle': 'MAC Address',		'mData':'mac' },
     { 'sTitle': 'Description',	'mData':'description' },
     { 'sTitle': 'Policy',	'mData':'policy', 'sClass': 'policyDrop' }],
  'fnInitComplete': function(){
    $('.policyDrop').editable(function(value, settings){
      var cPos = lt.fnGetPosition(this)
      lt.fnUpdate(value,cPos[0],cPos[1]);
      return value;
    },

    {
    'data': " {'Off':'Off','Allow':'Allow', 'Deny':'Deny'}",
    'type':'select',
    'onblur':'submit',
    'event': 'dblclick'
    }
  ),

  $('td', this.fnGetNodes()).editable(function(value, settings){
      var cPos = lt.fnGetPosition(this)
      lt.fnUpdate(value,cPos[0],cPos[1]);
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
 });

$('#add').click( function (e) {
    e.preventDefault();
     
    var aiNew = lt.fnAddData( 
      { 
      "MAC Address": '(Click to Enter)', 
      "Description": "(Click to Enter)", 
      "Policy": "(Click to Enter)"
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
