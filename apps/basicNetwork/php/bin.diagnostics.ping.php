<?php

// header('Content-type: text/ecmascript');

// $pingLimit = array_key_exists('pingLimit', $_REQUEST) ? $_REQUEST['pingLimit'] : 5;

// $pingTarget = array_key_exists('pingTarget', $_REQUEST) ? $_REQUEST['pingTarget'] : 'localhost';

// exec("/bin/ping -c $pingLimit $pingTarget",$pingResults);

// var_dump($pingResults);

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$fake_info = array(
 'Seq'=>"/^Seq (.*)/",
 'Address'=>"/^Address (.*)/",
 'RX'=>"/^RX (.*)/",
 'TTL'=>"/^TTL (.*)/",
 'RTT'=>"/^RTT (.*)/",
 '+/-'=>"/^ms (.*)/"
 );

$fakeFile = <<<EOF
# I made all this up, duh

host abc {
Seq 1;
Address 10.0.134.90;
RX 1;
TTL 64;
RTT 3;
ms 2;
}

host def {
Seq 2;
Address 10.0.134.90;
RX 1;
TTL 64;
RTT 3;
ms 2;
}

host ghi {
Seq 3;
Address 10.0.134.90;
RX 1;
TTL 64;
RTT 3;
ms 2;
}

EOF
;


function parsefakeinfo(){ global $fakeFile; global $fake_info;
  preg_match_all("/^host ([^ ]*) {([^}]*)/m",$fakeFile, $sg);
  $ping_info = array();
   for($i=0; $i<count($sg[0]); $i++){
    $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
    foreach($fake_info as $k => $v){
     $ping_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
    }
   }
 return $ping_info;
}





 echo json_encode( array( 'ping'=>parsefakeinfo() ) , JSON_PRETTY_PRINT );

?>