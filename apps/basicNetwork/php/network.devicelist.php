<?php

 header('Content-type: text/ecmascript');

$dhcp_info = array(
 'start'=>"/^starts [\d]* (.*)/",
 'end'=>"/^ends [\d]* (.*)/",
 'last'=>"/^cltt [\d]* (.*)/",
 'mac'=>"/^hardware [^ ]* ([:0-9A-Fa-f]*)/",
 'state'=>"/^binding state (.*)/",
 'hostname'=>"/^client-hostname \"([^\"]*)\"/"
);
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
$arp_list = array(
 "? (10.0.134.100) at 20:6a:8a:6d:45:05 [ether] on br0",
 "? (192.168.134.1) at c0:c1:c0:11:2c:1b [ether] on eth0"
);

function parsedhcpLeases(){ global $dl; global $dhcp_info;
// $dl = file_get_contents("/var/lib/dhcp/dhcpd.leases");


 preg_match_all("/^lease ([^ ]*) {([^}]*)/m",$dl, $dg);
 $dhcp_clients = array();
 for($i=0; $i<count($dg[0]); $i++){
  $dli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($dg[2][$i])));
  $dhcp_clients[$i] = array('src'=>'dhcp', 'ip'=>$dg[1][$i], 'device'=>$GLOBALS['conf']->lan->if);
  foreach($dhcp_info as $k => $v){
   $dhcp_clients[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$dli)));
  }
  $dhcp_clients[$i]['mac'] = strtoupper($dhcp_clients[$i]['mac']);
 }

// echo json_($dhcp_clients);
// exit;

 return $dhcp_clients;
}

function parseArpList(){ global $arp_list;
 // exec("/usr/sbin/arp -na",$arp_list);
 $arp_list = preg_filter("/^\? \(([^)]*)\) at ([^ ]*) \[[^\]]*\] on (.*)/","$1,$2,$3",$arp_list);
 foreach($arp_list as &$arp_entry){
  $arp_entry = explode(',',$arp_entry);
  $arp_entry = array( 'src'=>'arp', 'ip'=>$arp_entry[0], 'mac'=>strtoupper($arp_entry[1]), 'device'=>$arp_entry[2], 'start'=>null, 'end'=>null, 'last'=>null, 'state'=>null, 'hostname'=>null );
 }
 return $arp_list;
}

 $dhcp = parsedhcpLeases();
 $arp = parseArpList();

// TODO: Resolve conflicting lists
// foreach($dhcp as $di){
//  foreach($arp as $ak => $ai){
//  }
// }


//echo 'var devicelist = '. json_encode( array_merge(parsedhcpLeases(),parseArpList()), JSON_PRETTY_PRINT );

 echo json_encode( array( 'devicelist'=>array_merge($dhcp,$arp) ) , JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge($dhcp,$arp) ) ); //,JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge(parsedhcpLeases(),parseArpList()) ) ); //,JSON_PRETTY_PRINT );

?>
