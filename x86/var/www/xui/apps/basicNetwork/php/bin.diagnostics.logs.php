<?php
// header('Content-type: text/ecmascript');

function getLogList(){
 foreach(preg_replace("|/var/log/|",'',glob('/var/log/*.log')) as $lf){
  echo "<option value='". $lf ."'>". $lf ."</option>\n";
 }
}

/*
$act=$_REQUEST['act'];
$log=$_REQUEST['log'];
$lines=$_REQUEST['lines'];
$find=$_REQUEST['find'];
*/
//exec("sudo ./logs.sh $act $log $lines '$find'",$out);
/*
switch($act){
 case "list":{ echo "logs=['". implode("','",$out) ."']\n"; break; }
 default:{ echo implode("\n",$out); }
}
*/

?>
