<?php

 header('Content-type: text/ecmascript');
 include('bin.sys.php');

function parsedhcpLeases(){
/*
$dhcp_info = array(
 'starts'=> array( 'name'=>'start', 'search'=>"/^starts [\d]* (.*)/" ),
 'ends'=> array( 'name'=>'end', 'search'=>"/^ends [\d]* (.*)/" ),
 'cltt'=> array( 'name'=>'last', 'search'=>"/^cltt [\d]* (.*)/" ),
 'hardware'=> array( 'name'=>'mac', 'search'=>"/^hardware [^ ]* ([:0-9A-F]*)/" ),
 'binding state'=> array( 'name'=>'state', 'search'=>"/^binding state (.*)/" ),
 'client-hostname'=> array( 'name'=>'hostname', 'search'=>"/^client-hostname \"([^\"]*)\"/" )
);
*/

$dhcp_info = array(
 'start'=>"/^starts [\d]* (.*)/",
 'end'=>"/^ends [\d]* (.*)/",
 'last'=>"/^cltt [\d]* (.*)/",
 'mac'=>"/^hardware [^ ]* ([:0-9A-F]*)/",
 'state'=>"/^binding state (.*)/",
 'hostname'=>"/^client-hostname \"([^\"]*)\"/"
);

//var_dump($dhcp_info );

//return;

// $dl = file_get_contents("/var/lib/dhcp/dhcpd.leases");
$dl = <<<EOF
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
 preg_match_all("/^lease ([^ ]*) {([^}]*)/m",$dl, $dg);
 $dhcp_clients = array();
 for($i=0; $i<count($dg[0]); $i++){
  $dli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($dg[2][$i])));
  $dhcp_clients[$i] = array();
  $dhcp_clients[$i]['src'] = 'dhcp';
  $dhcp_clients[$i]['ip'] = $dg[1][$i];
  foreach($dhcp_info as $k => $v){
   $dhcp_clients[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$dli)));
  }
 }
 return $dhcp_clients;
}

function parseArpList(){ // exec("/usr/sbin/arp -na",$arp_list);
$arp_list = array(
 "? (10.0.134.100) at 20:6a:8a:6d:45:05 [ether] on br0",
 "? (192.168.134.1) at c0:c1:c0:11:2c:1b [ether] on eth0"
);

 $arp_list = preg_filter("/^\? \(([^)]*)\) at ([^ ]*) \[[^\]]*\] on (.*)/","$1,$2,$3",$arp_list);
 foreach($arp_list as &$arp_entry){
  $arp_entry = explode(',',$arp_entry);
  $arp_entry = array( 'src'=>'arp', 'ip'=>$arp_entry[0], 'mac'=>strtoupper($arp_entry[1]), 'device'=>$arp_entry[2] );
 }
 return $arp_list;
}

echo json_encode( array_merge(parsedhcpLeases(),parseArpList()), JSON_PRETTY_PRINT );

//echo 'var devicelist = '. 
// echo json_encode( array( 'aaData'=>array_merge(parsedhcpLeases(),parseArpList()) ) ); //,JSON_PRETTY_PRINT );

?>
