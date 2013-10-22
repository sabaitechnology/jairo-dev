<?php

 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

$fake_info = array(
 'mac'=>"/^hardware [^ ]* ([:0-9A-F]*)/",
 'description'=>"/^description (.*)/",
 'policy'=>"/^policy (.*)/"
);

$sl = <<<EOF
host abc {
  hardware ethernet 08:00:07:26:c0:a5;
  description router stuff;
  policy Off;
}

host def {
  hardware ethernet 08:00:07:26:c0:a6;
  description other stuff;
  policy Deny;
}

host ghi {
  hardware ethernet 08:00:07:26:c0:a7;
  description router fun;
  policy Allow;
}

EOF
;

function parsemacfilter(){ global $sl; global $fake_info;// $dl = file_get_contents("/var/lib/dhcp/dhcpd.leases");
 preg_match_all("/^host ([^ ]*) {([^}]*)/m",$sl, $sg);
 $mac_info = array();
 for($i=0; $i<count($sg[0]); $i++){
  $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
  $mac_info[$i] = array('hostname'=>$sg[1][$i]);
  foreach($fake_info as $k => $v){
   $mac_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
  }
  $mac_info[$i]['mac'] = strtoupper($mac_info[$i]['mac']);
 }
 return $mac_info;
}

 echo json_encode( array( 'macfilter'=>parsemacfilter() ) ,JSON_PRETTY_PRINT );


?>
