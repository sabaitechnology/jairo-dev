<?php
 header('Content-type: text/ecmascript');

 $act=$_REQUEST['act'];
 $log=$_REQUEST['log'];
 $lines=$_REQUEST['lines'];
 $find=$_REQUEST['find'];
 $logPath = '/var/log/';
//exec("sudo ./logs.sh $act $log $lines '$find'",$out);

// echo json_encode($_REQUEST, JSON_PRETTY_PRINT);

 readfile($logPath . $log);

// echo implode("\n",$out); }

?>

