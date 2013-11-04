<?php

 header('Content-type: text/ecmascript');

$fake_info = array(
 'Last Seen'=>"/^Last Seen (.*)/",
 'SSID'=>"/^SSID (.*)/",
 'BSSID'=>"/^BSSID (.*)/",
 'RSSI'=>"/^RSSI (.*)/",
 'Noise'=>"/^Noise (.*)/",
 'Quality'=>"/^Quality (.*)/",
 'Ch'=>"/^Ch (.*)/",
 'Capabilities'=>"/^Capabilities (.*)/",
 'Rates'=>"/^Rates (.*)/"
);

$fakeFile = <<<EOF
# I made all this up, duh

host abc {
Last Seen 2013/06/01;
SSID 10101010;
BSSID 20202020;
RSSI 30303030;
Noise Loud;
Quality Bad;
Ch 24;
Capabilities Few;
Rates Expensive;
}

host def {
Last Seen 2013/06/02;
SSID 10101011;
BSSID 20202021;
RSSI 30303031;
Noise Quiet;
Quality Awesome;
Ch 22;
Capabilities Extensive;
Rates Don't Ask;
}

host ghi {
Last Seen 2013/06/03;
SSID 10101012;
BSSID 20202022;
RSSI 30303032;
Noise Moderate;
Quality Medium;
Ch 23;
Capabilities Some;
Rates Yes;
}

EOF
;


function parsefakeinfo(){ global $fakeFile; global $fake_info;
	preg_match_all("/^host ([^ ]*) {([^}]*)/m",$fakeFile, $sg);
	$survey_info = array();
	 for($i=0; $i<count($sg[0]); $i++){
	  $sli = explode(';',preg_replace(array("/^[ ]{1,}/m","/\n/"),'',trim($sg[2][$i])));
	  foreach($fake_info as $k => $v){
	   $survey_info[$i][$k] = preg_filter($v,"$1",array_shift(preg_grep($v,$sli)));
	  }
	 }
 return $survey_info;
}





 echo json_encode( array( 'survey'=>parsefakeinfo() ) , JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge($dhcp,$arp) ) ); //,JSON_PRETTY_PRINT );

// echo json_encode( array( 'devicelist'=>array_merge(parsedhcpLeases(),parseArpList()) ) ); //,JSON_PRETTY_PRINT );

?>
