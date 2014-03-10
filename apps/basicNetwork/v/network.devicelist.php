<?php
// include('../php/sys.php');
?>

<div class='pageTitle'>Network: Device List</div>
<!--
 DHCP Leases
 ARP List
 Static Addresses?
-->

<div class='controlBox'>
	<span class='controlBoxTitle'>Summary</span>
	<div class='controlBoxContent' id='devicelist'>
		<br>
		<span class='smallText'><b>See Also:</b>
			<a href="?panel=network&section=staticips" target="_blank">Static IPs</a>, 
			<a href="?panel=network&section=lan" target="_blank">LAN</a>
		</span>
	</div>
</div>

<script type='text/ecmascript'>

$.widget("jai.devicelist", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .prepend( $(document.createElement('table'))
    	.addClass("listTable")
    	.prop("id","list") 
    )
	  
    $('#list').dataTable({
		'bPaginate': false,
		'bInfo': false,
		'bFilter': false,
		"sAjaxDataProp": "devicelist",
		"sAjaxSource": "php/network.devicelist.php",
		"aoColumns": [
			{ "sTitle": "Type",		"mData":"src" },
			{ "sTitle": "Address",	"mData":"ip" },
			{ "sTitle": "MAC",		"mData":"mac" },
			{ "sTitle": "Link",		"mData":"device" },
			{ "sTitle": "Name",		"mData":"hostname" },
			{ "sTitle": "Lease State",	"mData":"state" },
			{ "sTitle": "Lease Starts",	"mData":"start" },
			{ "sTitle": "Lease Ends",	"mData":"end" },
			{ "sTitle": "Last Contact",	"mData":"last" }
		]
		})

	  this._super();
  }
});

$(function(){
  //instatiate widgets on document ready
  $('#devicelist').devicelist();
})


</script>
