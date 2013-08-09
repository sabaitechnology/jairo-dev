<?php
// include('../php/bin.sys.php');
?>
<div class='pageTitle'>Network: Device List</div>
<!--
 DHCP Leases
 ARP List
 Static Addresses?
-->
<div class='controlBox'><span class='controlBoxTitle'>Demo</span><div class='controlBoxContent'>
 <table id='list' class='listTable'></table>
<!-- input type='button' value='test' onclick='sub();' -->
</div></div>

<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript'>
 $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  "sAjaxDataProp": "devicelist",
  "sAjaxSource": "php/bin.network.devicelist.php",
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

//$(function(){});
</script>
