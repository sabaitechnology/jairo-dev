<div class='pageTitle'>Wireless: MAC Filter</div>

<div class='controlBox'><span class='controlBoxTitle'>Filter Settings</span>
	<div class='controlBoxContent' id='macfilter'>
		
<!-- 		<table class='controlTable'><tbody>
     <tr><td>Set Policy: </td><td>
      <select id='default_policy' name='default_policy' class='radioSwitchElement'>
       <option value='allow'>Allow</option>
       <option value='deny'>Deny</option>
      </select>
     </td></tr>
    </tbody></table>



<h3>Allow</h3>
		<table id='allowList' class='listTable clickable'></table>
		<input type='button' value='Add' id='allowAdd'>
		<input type='button' value='Cancel' onclick='cancelMAC();'>


<h3>Deny</h3>
		<table id='denyList' class='listTable clickable'></table>
		<input type='button' value='Add' id='denyAdd'>
		<input type='button' value='Cancel' onclick='cancelMAC();'>
<br>

		<input type='button' value='Save' id='save'> -->

	</div>
</div>

<script type='text/ecmascript' src='php/etc.php?q=macfilter'></script>
<script type='text/ecmascript'>


$.widget("jai.macfilter", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
	  
    this._super();
    
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
		.append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Set Policy: ') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select'))
                .prop("id","default_policy")
                .prop("name","default_policy")
                .prop("class", "radioSwitchElement")
            	.append( $(document.createElement('option'))
            		.prop("value", "allow")
            		.prop("text", 'Allow')
            	)
            	.append( $(document.createElement('option'))
            		.prop("value", "deny")
            		.prop("text", 'Deny')
            	)
            ) //end select 
          ) // end td
        ) // end type tr
      ) // end first tbody
    ) //end table
	.append( $(document.createElement('h3')).html('Allow')) 
	.append( $(document.createElement('table'))
		.prop("id", "allowList")
		.addClass("listTable clickable") 
	)
  .append( $(document.createElement('input'))
	  .prop("type", "button")
	  .prop("id", "allowAdd")
	  .prop("value", "Add")
  )
  .append( $(document.createElement('input'))
	  .prop("type", "button")
	  .prop("id", "cancel")
	  .prop("value", "Cancel")
	  .prop("onClick", "cancelMAC();")
  )

	.append( $(document.createElement('h3')).html('Deny'))
		.append( $(document.createElement('table'))
			.prop("id", "denyList")
		.addClass("listTable clickable") 
	)
  .append( $(document.createElement('input'))
	  .prop("type", "button")
	  .prop("id", "denyAdd")
	  .prop("value", "Add")
  )
  .append( $(document.createElement('input'))
	  .prop("type", "button")
	  .prop("id", "cancel")
	  .prop("value", "Cancel")
	  .prop("onClick", "cancelMAC();")
  )

  .append( $(document.createElement('br')))
  .append( $(document.createElement('input'))
  	.prop("type", "button")
  	.prop("id", "save")
  	.prop("value", "Save")
  	.prop("onClick", "SaveMAC();")
  )

  // .append( $(document.createElement('span'))
  //  .addClass('xsmallText')
  //  .html("(Double-Click Fields to Edit)")
  // )

  $('#default_policy').radioswitch({ value: macfilter.policy });

	//	policy = $('#default_policy').val();

	function customRowCallBack(nRow, aData, iDisplayIndex, iDisplayIndexFull){
		$(nRow).find('.plainText').editable(
			function(value, settings){ return value; },
			{
				'onblur':'submit',
				'event': 'dblclick',
				'placeholder' : '(Click to edit)',
			}
		);
	}

	var addTable =  $('#allowList').dataTable({
		'bPaginate': false,
		'bInfo': false,
		'bFilter': false,
		'aaData': macfilter.allow,
		'aoColumns': [
			{ 'sTitle': 'MAC Address',	'mData':'mac',			'sClass': 'plainText'		},
			{ 'sTitle': 'Description',	'mData':'description',	'sClass': 'plainText'		}
		],
		'fnRowCallback': customRowCallBack
	});

	var denyTable =  $('#denyList').dataTable({
		'bPaginate': false,
		'bInfo': false,
		'bFilter': false,
		'aaData': macfilter.deny,
		'aoColumns': [
			{ 'sTitle': 'MAC Address',	'mData':'mac',			'sClass': 'plainText'		},
			{ 'sTitle': 'Description',	'mData':'description',	'sClass': 'plainText'		}
		],
		'fnRowCallback': customRowCallBack
	});


	$('#denyAdd').click(function(e){
		e.preventDefault();
		denyTable.fnAddData({ "mac": null, "description": null });
	});
	$('#allowAdd').click(function(e){
		e.preventDefault();
		addTable.fnAddData({ "mac": null, "description": null });
	});



  },

  //global save method
  saveMAC: function(){  
  console.log("yo dog we savin'")
  var oTable = $('#dhcp_static').dataTable();
		var data = oTable.fnGetData()
		console.log(data)
		pForm = data
    return pForm;
 
  },

  addStatic: function(){
  		
		// e.preventDefault();
		$('#macfilter').macfilter().fnAddData(
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
  $('#macfilter').macfilter({ conf: macfilter });
})



</script>
