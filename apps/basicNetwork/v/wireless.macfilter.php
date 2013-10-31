<div class='pageTitle'>Wireless: MAC Filter</div>

<div class='controlBox'><span class='controlBoxTitle'>Filter Settings</span>
	<div class='controlBoxContent'>
		
		<table class='controlTable'><tbody>
     <tr><td>Set Policy: </td><td>
      <select id='default_policy' name='default_policy' class='radioSwitchElement'>
       <option value='Allow'>Allow</option>
       <option value='Deny'>Deny</option>
      </select>
     </td></tr>
    </tbody></table>
    
    <br>

		<table id='list' class='listTable clickable'></table>
		
		<input type='button' value='Add' id='add'>
		<input type='button' value='Save' id='save'>
		<input type='button' value='Cancel' onclick='cancelMAC();'>

	</div>
</div>

<script type='text/ecmascript' src='php/bin.etc.php?q=macfilter'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

	$('#save').click( function() {
		toServer('Save this.');
	});

	$('#default_policy').radioswitch({
	 value: macfilter.default
	});

	policy = $('#default_policy').val();

	var lt =  $('#list').dataTable({
		'bPaginate': false,
		'bInfo': false,
		'bFilter': false,
		'sAjaxDataProp': 'macfilter',
		'sAjaxSource': 'php/bin.wireless.macfilter.php',
		'aoColumns': [
			{ 'sTitle': 'MAC Address',	'mData':'mac',					'sClass': 'plainText'		},
			{ 'sTitle': 'Description',	'mData':'description',	'sClass': 'plainText'		}
			// { 'sTitle': 'Policy',				'mData':'policy',				'sClass': 'policy'}
		],

		'fnRowCallback': function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
			$(nRow).find('.plainText').editable(
				function(value, settings){ return value; },
				{
					'onblur':'submit',
					'event': 'dblclick',
					'placeholder' : '(Click to edit)',
				}
			);
		}
	});

	$('#add').click( function (e) {
		e.preventDefault();
		lt.fnAddData(
			{
				"mac": null, 
				"description": null 
				// "policy": policy
			}
		);
	});


</script>
