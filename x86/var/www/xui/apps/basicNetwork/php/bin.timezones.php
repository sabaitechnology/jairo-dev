<?php
 header('Content-type: text/ecmascript');
// include(__DIR__ .'/bin.sys.php');

 function getZones($d){ $a = array();
  foreach(scandir($d) as $i){ if( $i[0]=='.' ) continue; $a[] = ( is_dir($d.$i) ? array( $i => getZones($d.$i.'/') ) : $i ); }
  return $a;
 }

 $ignoreZoneFiles = array(
  'zone.tab',
  'localtime',
  'iso3166.tab',
  'posix',
  'posixrules',
  'right'
 );

 function showZoneList($d, $pre, $proper_print = false, $level = 0){ 
  echo ($proper_print?str_repeat("\t", $level):''). '<ul>'. ($proper_print?"\n":'');
  foreach(scandir($d) as $i){
   if( $i[0]=='.' || in_array($i,$GLOBALS['ignoreZoneFiles']) ) continue;
   echo ($proper_print?str_repeat("\t", $level+1):''). "<li data-zone=\"". ($pre==''?'':$pre.'/'). $i ."\"><a>". $i ."</a>";
   if(is_dir($d.$i)){
    echo ($proper_print?"\n":'');
    showZoneList($d.$i.'/', ($pre==''?'':$pre.'/').$i, $proper_print, $level + 2);
    echo ($proper_print? ("\n".str_repeat("\t", $level+1)) :'');
   }
   echo '</li>'. ($proper_print?"\n":'');
  }
  echo ($proper_print?str_repeat("\t", $level):''). '</ul>';
 }

 showZoneList('/usr/share/zoneinfo/', '', true);

// echo json_encode(getZones('/usr/share/zoneinfo/'),JSON_PRETTY_PRINT);

// foreach(preg_replace(array("|/var/log/|","/\.log$/"),'',glob('/var/log/*.log')) as $lf) echo "<option value='". $lf ."'>". $lf ."</option>\n";


?>
