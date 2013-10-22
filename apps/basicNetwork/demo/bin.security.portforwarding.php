<?php

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$fake_info = array(
 'On'=>"/^On (.*)/",
 'Proto'=>"/^Proto (.*)/",
 'VPN'=>"/^VPN (.*)/",
 'Src Address'=>"/^Src Address (.*)/",
 'Ext Port'=>"/^Ext Port (.*)/",
 'Int Port'=>"/^Int Port (.*)/",
 'Int Address'=>"/^Int Address (.*)/",
 'Description'=>"/^Description (.*)/"
 );

$fakeFile = <<<EOF
# I made all this up, duh

host abc {
On On;
Proto UDP;
VPN WAN;
Src Address 1.1.1.0/22;
Ext Port 1000-2000;
Int Port ;
Int Address 10.10.1.1;
Description ex:restricted;
}

host def {
On Off;
Proto TCP;
VPN WAN;
Src Address 1.1.1.0/24;
Ext Port 1000;
Int Port 2000;
Int Address 10.10.1.2;
Description ex: alt int port;
}

host ghi {
On Off;
Proto Both;
VPN WAN;
Src Address ;
Ext Port 3000;
Int Port ;
Int Address 10.10.1.3;
Description ;
}

EOF
;


function parsefakeinfo(){ global $fakeFile; global $fake_info;
  preg_match_all("/^host ([^ ]*) {([^}]*)/m",$fakeFile, $sg);
  $portforwarding_info = array();
   for($i=0; $i<count($sg[0]); $i++){
    $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
    foreach($fake_info as $k => $v){
     $portforwarding_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
    }
   }
 return $portforwarding_info;
}





 echo json_encode( array( 'portforwarding'=>parsefakeinfo() ) , JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge($dhcp,$arp) ) ); //,JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge(parsedhcpLeases(),parseArpList()) ) ); //,JSON_PRETTY_PRINT );

?>
