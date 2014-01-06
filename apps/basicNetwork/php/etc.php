<?php
 header('Content-type: text/ecmascript');
 
 function getConf($q, $debug){
  $conf = json_decode(file_get_contents(__DIR__.'/../etc.js'));
  foreach(explode(',','sys,'. $q) as $i){
   if($debug) echo "/* $i */\n";
   if(array_key_exists($i,$conf))
    echo $i .' = '. json_encode($conf->$i, ($debug) ? JSON_PRETTY_PRINT : null ) .";\n";
  }
 }

 $debug = array_key_exists('debug',$_REQUEST);

 if(array_key_exists('time',$_REQUEST)){
   echo 'now = '. json_encode(explode(',',date("Y,n,j,g,i,A"))) .";\n";
 }
 if(array_key_exists('q',$_REQUEST)) getConf($_REQUEST['q'], $debug);

?>
