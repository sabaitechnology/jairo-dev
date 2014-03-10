<div class='pageTitle'>Network: Static IPs</div>

<!--
 TODO: 
 DHCP Leases
 ARP List
 Static Addresses?
 Determine Cancel/Save functionality
 Use packet size
-->

<div class='controlBox'><span class='controlBoxTitle'>Static Devices</span>
	<div class='controlBoxContent' id='staticdevices'>
	<div>
	<br>
	<input type="button" id="add" value="Add"></input>
	<input type="button" id="save" value="Save"></input>
	<input type="button" id="cancel" value="Cancel"></input>
</div>

<pre id='testing'>
</pre>

<script type='text/ecmascript'>
	
var pForm = {}

$.widget("jai.staticdevices", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
	  
    this._super();
    
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .prepend( $(document.createElement('table'))
      .addClass("listTable")
      .prop("id","dhcp_static") 
    )
    // .append( $(document.createElement('input'))
    //  .prop("type", "button")
    //  .prop("id", "add")
    //  .prop("value", "Add")
    // )
    // .append( $(document.createElement('input'))
    //  .prop("type", "button")
    //  .prop("id", "save")
    //  .prop("value", "Save")
    //  .prop("onClick", "saveStatic();")
    // )
    // .append( $(document.createElement('input'))
    //  .prop("type", "button")
    //  .prop("id", "cancel")
    //  .prop("value", "Cancel")
    //  .prop("onClick", "cancelStatic();")
    // )
    // .append( $(document.createElement('span'))
    //  .addClass('xsmallText')
    //  .html("(Double-Click Fields to Edit)")
    // )

    var lt =  $('#dhcp_static').dataTable({
      'bPaginate': false,
      'bInfo': false,
      'bFilter': false,
      'sAjaxDataProp': 'staticips',
      'sAjaxSource': 'php/network.staticips.php',
      'aoColumns': [
        { 'sTitle': 'MAC',      'mData':'mac',          'sClass': 'plainText'   },
        { 'sTitle': 'Address',  'mData':'ip',           'sClass': 'plainText'   },
        { 'sTitle': 'Name',     'mData':'hostname',     'sClass': 'plainText'  }
      ],

      'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
        $(nRow).find('.plainText').editable(
          function(value, settings){ return value; },
          {
            'onblur':'submit',
            'event': 'dblclick',
            'placeholder' : '(Double-click to edit)',
          }
        );
      } 
    });

  },

  //global save method
  saveStatic: function(){  
  console.log("yo dog we savin'")
  var oTable = $('#dhcp_static').dataTable();
		var data = oTable.fnGetData()
		console.log(data)
		pForm = data
    return pForm;
 
  },

  addStatic: function(){
  		
		// e.preventDefault();
		$('#dhcp_static').dataTable().fnAddData(
			{
				"mac": null, 
				"ip": null, 
				"hostname": null
			}
		)
  }
});

$(function(){
  //instatiate widgets on document ready
  $('#staticdevices').staticdevices();
})

$('#add').click( function () {
	console.log('adding')
	$('#staticdevices').staticdevices('addStatic')
});

$('#save').click( function() {
	console.log('saving')
  //FIGURE OUT HOW TO join pforms
  $('#staticdevices').staticdevices('saveStatic')
  toServer(pForm, 'save');
});  



</script>
