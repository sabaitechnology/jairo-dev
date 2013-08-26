<div class='pageTitle'>Wireless: MAC Filter</div>

<div class='controlBox'><span class='controlBoxTitle'>WL0</span>
	<div class='controlBoxContent'>
		<table id='list' class='listTable'></table>

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
   { 'sTitle': 'Policy',	'mData':'policy' }

  ]
 });

</script>
