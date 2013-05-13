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
 $dl1 = file_get_contents("/var/lib/dhcp/dhcpd.leases");
$dl2 = <<<EOF
# The format of this file is documented in the dhcpd.leases(5) manual page.
# This lease file was written by isc-dhcp-4.1-ESV-R4

lease 10.0.134.100 {
  starts 6 2013/05/11 00:13:39;
  ends 0 2013/05/12 00:13:39;
  tstp 0 2013/05/12 00:13:39;
  cltt 6 2013/05/11 00:13:39;
  binding state free;
  hardware ethernet 20:6a:8a:6d:45:05;
}
lease 10.0.134.102 {
  starts 6 2013/05/11 00:14:41;
  ends 0 2013/05/12 00:14:41;
  tstp 0 2013/05/12 00:14:41;
  cltt 6 2013/05/11 00:14:41;
  binding state free;
  hardware ethernet 00:24:2b:aa:16:a5;
  uid "\\001\\000$+\\252\\026\\245";
}
server-duid "\\000\\001\\000\\001\\031\\022\\315P\\000\\0072#\\017&";

lease 10.0.134.100 {
  starts 1 2013/05/13 14:19:15;
  ends 2 2013/05/14 14:19:15;
  cltt 1 2013/05/13 14:19:15;
  binding state active;
  next binding state free;
  hardware ethernet 20:6a:8a:6d:45:05;
  client-hostname "Camus";
}

EOF
;

$dn = explode("\n",$dl1);
$dm = explode("\n",$dl2);

for($i=0; $i<count($dn); $i++){
 echo strcmp($dn[$i],$dm[$i]) ."\n";
}

// $dl = trim(preg_replace(array("/^#[^\n]*/m","/\n{1,}/","/^[ \t]+/m"),array('',"\n",''),$dl));
// $dl = preg_replace(array("/\n/"),'',$dl);
// $dl = preg_replace(array("/^lease/","/^}/"),"\n",$dl);

// echo "~$dl~";


// preg_match_all("/^lease ([^ ]*) {([^}]*)/m",$dl, $dg);

// var_dump($dg);

// echo preg_replace("/lease ([^ ]*) /","\n - $1~$2 - \n",$dl);

// $df = preg_filter("/lease ([^ ]*) {([^}]*)/","~ $1 : $2 ~",$dl);

// var_dump($dl);
// echo "\n---\n";
// var_dump($df);
// exit;
// return $dl;
}

function parseArpList(){ global $rtd;

// exec("/usr/sbin/arp -na",$al);
$al = array(
 "? (10.0.134.100) at 20:6a:8a:6d:45:05 [ether] on br0",
 "? (192.168.134.1) at c0:c1:c0:11:2c:1b [ether] on eth0"
);
// foreach($al as $ai){
//  echo preg_filter("/? ([^)])* at ([^ ]*) \[[^\]]\] on (.*)/","$1,$2,$3",$ai);
//  echo preg_filter("/^\? \(([^)]*)\) at ([^ ]*) \[[^\]]*\] on (.*)/","~:$1,$2,$3:~ ",$ai) ."\n";
// }

// exit;
/*
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
*/
// return $dl;
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
