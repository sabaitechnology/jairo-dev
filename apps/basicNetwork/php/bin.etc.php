<?php
 header('Content-type: text/ecmascript');
 include(__DIR__ .'/bin.sys.php');

 $debug = array_key_exists('debug',$_REQUEST);


 if(array_key_exists('q',$_REQUEST)) getConf($_REQUEST['q'], $debug);
 if(array_key_exists('w',$_REQUEST)) setConf($_REQUEST['w']);

 if(array_key_exists('time',$_REQUEST)){
  if($_REQUEST['time'] == 'current'){
   echo 'current = '. json_encode(explode(',',date("Y,n,j,g,i,A"))) .";\n";
  }
 }

?>
