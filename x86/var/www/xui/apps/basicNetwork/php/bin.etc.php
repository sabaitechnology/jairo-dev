<?php
 header('Content-type: text/ecmascript');
 include('bin.sys.php');

 if(array_key_exists('q',$_REQUEST)) getConf($_REQUEST['q']);
 if(array_key_exists('w',$_REQUEST)) setConf($_REQUEST['w']);

?>
