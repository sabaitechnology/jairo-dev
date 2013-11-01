<div class='pageTitle'>Wireless: MAC Filter</div>

<div class='controlBox'><span class='controlBoxTitle'>Filter Settings</span>
	<div class='controlBoxContent'>
		
		<table class='controlTable'><tbody>
     <tr><td>Set Policy: </td><td>
      <select id='default_policy' name='default_policy' class='radioSwitchElement'>
       <option value='allow'>Allow</option>
       <option value='deny'>Deny</option>
      </select>
     </td></tr>
    </tbody></table>
    
    <br>


<h3>Allow</h3>
		<table id='allowList' class='listTable clickable'></table>
		<input type='button' value='Add' id='allowAdd'>

<h3>Deny</h3>
		<table id='denyList' class='listTable clickable'></table>
		<input type='button' value='Add' id='denyAdd'>

<br>

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

</script>
