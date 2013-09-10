<?php

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$static_info = array(
 'mac'=>"/^hardware [^ ]* ([:0-9A-F]*)/",
 'ip'=>"/^fixed-address ([0-9.]*)/",
 'dlva' =>"/^dlva (.*)/"
);

$sl = <<<EOF
host abc {
  hardware ethernet 08:00:07:26:c0:a5;
  fixed-address 10.0.134.90;
  dlva Default
}

host def {
  hardware ethernet 08:00:07:26:c0:a6;
  fixed-address 10.0.134.91;
  dlva Local
}

host ghi {
  hardware ethernet 08:00:07:26:c0:a7;
  fixed-address 10.0.134.92;
  dlva Default
}

EOF
;

function gateway(){ global $sl; global $static_info;// $dl = file_get_contents("/var/lib/dhcp/dhcpd.leases");
 preg_match_all("/^host ([^ ]*) {([^}]*)/m",$sl, $sg);
 $gateway_info = array();
 for($i=0; $i<count($sg[0]); $i++){
  $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
  $gateway_info[$i] = array('hostname'=>$sg[1][$i]);
  foreach($static_info as $k => $v){
   $gateway_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
  }
  $gateway_info[$i]['mac'] = strtoupper($gateway_info[$i]['mac']);
 }
 return $gateway_info;
}

// echo json_encode( array( 'staticips'=>gateway() ) ); //,JSON_PRETTY_PRINT );
 echo json_encode( array( 'gateway'=>gateway() ) ,JSON_PRETTY_PRINT );


//if(!array_key_exists('sub',$_REQUEST)) return;

// file_put_contents('phpsubje.txt',json_encode($_REQUEST, JSON_PRETTY_PRINT));

// echo "\n\n/*\n";
// var_dump($_REQUEST);
// echo "*/\n";

?>
