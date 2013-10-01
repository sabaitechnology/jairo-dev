<?php

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$fake_info = array(
 'Hop'=>"/^Hop (.*)/",
 'Address'=>"/^Address (.*)/",
 'Min'=>"/^Min (.*)/",
 'Max'=>"/^Max (.*)/",
 'Avg'=>"/^Avg (.*)/",
 '+/-'=>"/^ms (.*)/"
 );

$fakeFile = <<<EOF
# I made all this up, duh

host abc {
Hop 1;
Address 10.0.134.90;
Min 1;
Max 5;
Avg 3;
ms 2;
}

host def {
Hop 2;
Address 10.0.134.90;
Min 2;
Max 4;
Avg 3;
ms 3;
}

host ghi {
Hop 3;
Address 10.0.134.90;
Min 1;
Max 10;
Avg 7;
ms 4;
}

EOF
;


function parsefakeinfo(){ global $fakeFile; global $fake_info;
  preg_match_all("/^host ([^ ]*) {([^}]*)/m",$fakeFile, $sg);
  $trace_info = array();
   for($i=0; $i<count($sg[0]); $i++){
    $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
    foreach($fake_info as $k => $v){
     $trace_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
    }
   }
 return $trace_info;
}





 echo json_encode( array( 'trace'=>parsefakeinfo() ) , JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge($dhcp,$arp) ) ); //,JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge(parsedhcpLeases(),parseArpList()) ) ); //,JSON_PRETTY_PRINT );

?>
