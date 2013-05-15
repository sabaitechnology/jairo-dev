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
<table><tbody>
<tr><td></td><td></td></tr>
</tbody></table>

<table id='list'></table>

<input type='button' value='test' onclick='sub();'>

</div>

<div class='controlBox'>
<pre id='demov'></pre>
<pre id='demo'></pre>

</div>
</form>
<!-- script type='text/ecmascript' src='php/bin.network.devicelist.php'></script -->
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript'>

$(function(){
// $('#demo').html( devicelist );

//[{"src":"dhcp","ip":"10.0.134.100","start":"2013\/05\/11 00:13:39","end":"2013\/05\/12 00:13:39","last":"2013\/05\/11 00:13:39","mac":"20:6a:8a:6d:45:05","state":"free","hostname":null},{"src":"dhcp","ip":"10.0.134.102","start":"2013\/05\/11 00:14:41","end":"2013\/05\/12 00:14:41","last":"2013\/05\/11 00:14:41","mac":"00:24:2b:aa:16:a5","state":"free","hostname":null},{"src":"dhcp","ip":"10.0.134.100","start":"2013\/05\/13 14:19:15","end":"2013\/05\/14 14:19:15","last":"2013\/05\/13 14:19:15","mac":"20:6a:8a:6d:45:05","state":"active","hostname":"Camus"},{"src":"arp","ip":"10.0.134.100","mac":"20:6A:8A:6D:45:05","device":"br0"},{"src":"arp","ip":"192.168.134.1","mac":"C0:C1:C0:11:2C:1B","device":"eth0"}]

 $('#list').dataTable({
  "sAjaxSource": "php/bin.network.devicelist.php",
  "aoColumns": [
   { "mData": "src" },
   { "mData": "ip" },
   { "mData": "mac" },
   { "mData": "device" }
  ]
 });
});

</script>
