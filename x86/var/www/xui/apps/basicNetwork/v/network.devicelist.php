<?php
// include('../php/bin.sys.php');
?>
<form id='fe'>
<div class='pageTitle'>Network: Lan</div>
<div class='controlBox'>
<!--
 DHCP Leases
 ARP List
 Static Addresses?
-->
<table id='list'></table>
<!-- input type='button' value='test' onclick='sub();' -->
</div>

</form>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript'>
 $('#list').dataTable({
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
 });

//$(function(){ });
</script>
