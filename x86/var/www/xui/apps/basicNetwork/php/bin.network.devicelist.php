<?php

 include('bin.sys.php');

if(0){
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
<script type='text/ecmascript'>
<?php
}
header('Content-type: text/ecmascript');

function parsedhcpLeases(){ $dl = '';
// $dl = file_get_contents("$rtd/var/lib/dhcpd.leases");
 return $dl;
}

function parseArpList(){ global $rtd;
 $dl = file("$rtd/tmp/arp.list", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES );
 foreach($dl as &$line){
  $line = explode(' ',$line);
  if($line[0]=='?' && count($line)==7){
   $line = array( preg_replace("/[()]/",'',$line[1]), $line[3], $line[6] );
  }else if(count($line)==5){
   $line = array( $line[0], $line[2], $line[4] );
  }
  echo implode(', ',$line) ."\n";
 }

 echo "\n\n";
  echo json_encode($dl) ."\n";
// var_dump($dl);
 return $dl;
}


 $dhcpLeases = parsedhcpLeases();
 $arpTables = parseArpList();

return;
?>


$(function(){
 $('#list').dataTable({
  "aaData": [
  ],
  "aoColumns": [
  ]
 });
});

</script>
