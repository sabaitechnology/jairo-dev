<?php

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$static_info = array(
 'mac'=>"/^hardware [^ ]* ([:0-9A-F]*)/",
 'ip'=>"/^fixed-address ([0-9.]*)/"
);

//$sl = file_get_contents('/home/vae/x86/x86/etc/dhcp/dhcpd.conf');

$sl = <<<EOF
host abc {
  hardware ethernet 08:00:07:26:c0:a5;
  fixed-address 10.0.134.90;
}

host def {
  hardware ethernet 08:00:07:26:c0:a6;
  fixed-address 10.0.134.91;
}

host ghi {
  hardware ethernet 08:00:07:26:c0:a7;
  fixed-address 10.0.134.92;
}

EOF
;

function parseStaticLeases(){ global $sl; global $static_info;// $dl = file_get_contents("/var/lib/dhcp/dhcpd.leases");
 preg_match_all("/^host ([^ ]*) {([^}]*)/m",$sl, $sg);
 $static_clients = array();
 for($i=0; $i<count($sg[0]); $i++){
  $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
  $static_clients[$i] = array('hostname'=>$sg[1][$i]);
  foreach($static_info as $k => $v){
   $static_clients[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
  }
  $static_clients[$i]['mac'] = strtoupper($static_clients[$i]['mac']);
 }
 return $static_clients;
}

// echo json_encode( array( 'staticips'=>parseStaticLeases() ) ); //,JSON_PRETTY_PRINT );
 echo json_encode( array( 'staticips'=>parseStaticLeases() ) ,JSON_PRETTY_PRINT );


//if(!array_key_exists('sub',$_REQUEST)) return;

// file_put_contents('phpsubje.txt',json_encode($_REQUEST, JSON_PRETTY_PRINT));

// echo "\n\n/*\n";
// var_dump($_REQUEST);
// echo "*/\n";

?>
