<?php

 function setConf($w,$conf){
  // TODO: Assign values
  if(file_put_contents(__DIR__.'/../etc.new.js',json_encode($conf,JSON_PRETTY_PRINT),LOCK_EX) === FALSE) return; // TODO: Handle conf write failure
 }

 function getConf($q, $debug){ global $conf; //  $q = explode(',','sys,'. $q);//  $q[] = 'sys';
  foreach(explode(',','sys,'. $q) as $i){ if(array_key_exists($i,$conf)) echo $i .' = '. json_encode($conf->$i, ($debug) ? JSON_PRETTY_PRINT : null ) .";\n"; }
 }

 $conf = json_decode(file_get_contents(__DIR__.'/../etc.js'));

?>
