<?php

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$fake_info = array(
 'Destination'=>"/^Destination (.*)/",
 'Gateway'=>"/^Gateway (.*)/",
 'Genmask'=>"/^Genmask (.*)/",
 'Flags'=>"/^Flags (.*)/",
 'Metric'=>"/^Metric (.*)/",
 'Ref'=>"/^Ref (.*)/",
 'Use'=>"/^Use (.*)/",
 'Iface'=>"/^Iface (.*)/"
 );

$fakeFile = <<<EOF
# I made all this up, duh

host abc {
Destination 10.0.0.0;
Gateway 192.168.199.1;
Genmask 0.0.0.0;
Flags UG;
Metric 0;
Ref 0;
Use 0;
Iface eth0;
}

host def {
Destination 169.254.0.0;
Gateway 0.0.0.0;
Genmask 255.255.255.0;
Flags U;
Metric 1000;
Ref 0;
Use 0;
Iface eth0;

}

host ghi {
Destination 192.168.199.0;
Gateway 0.0.0.0;
Genmask 255.255.255.0;
Flags U;
Metric 1;
Ref 0;
Use 0;
Iface eth0;
}

EOF
;


function parsefakeinfo(){ global $fakeFile; global $fake_info;
  preg_match_all("/^host ([^ ]*) {([^}]*)/m",$fakeFile, $sg);
  $routing_info = array();
   for($i=0; $i<count($sg[0]); $i++){
    $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
    foreach($fake_info as $k => $v){
     $routing_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
    }
   }
 return $routing_info;
}





 echo json_encode( array( 'route'=>parsefakeinfo() ) , JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge($dhcp,$arp) ) ); //,JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge(parsedhcpLeases(),parseArpList()) ) ); //,JSON_PRETTY_PRINT );

?>
