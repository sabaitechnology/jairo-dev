<?php
 if (!headers_sent()){ header('Content-type: text/ecmascript'); }
 $logPath = '/var/log/';

function getLogs($path = '/var/log/'){
 $logs = scandir($path);
 $logList = array();

 foreach($logs as $log){
  if($log=='.' || $log=='..') continue; // ignore . and ..
  if(is_dir($path.$log)){
   $logList[]=array( $log => getLogs($path.$log) );
  }else{
   $logList[]=$log;
  }
 }
 return $logList;
}

$logs = getLogs();

echo json_encode($logs, JSON_PRETTY_PRINT) ."\n";

return;


 $act=array_key_exists('act', $_REQUEST) ? $_REQUEST['act'] : null;
 $log=array_key_exists('log', $_REQUEST) ? $_REQUEST['log'] : null;
 $lines=array_key_exists('lines', $_REQUEST) ? $_REQUEST['lines'] : null;
 $find=array_key_exists('find', $_REQUEST) ? $_REQUEST['find'] : null;


 $validPath = realpath($logPath . $log);

 if( (!empty($log)) && (strncmp($validPath, $logPath, 9) != 0) ){
 	echo "File not found.";
 	return;
 }

switch ($act) {
	case 'all':
		readfile($validPath);
	break;

	case 'first':
		exec("head -n $lines $validPath", $out);
		echo implode("\n",$out);
	break;

	case 'last':
		exec("tail -n $lines $validPath", $out);
		echo implode("\n",$out);
	break;

	case 'find':
		exec("grep '$find' $validPath", $out);
		echo implode("\n",$out);
	break;

	case 'list':
	default:

/*
 $logs = scandir($logPath);
 $logList = array();

 foreach($logs as $log){
  if($log=='.' || $log=='..') continue; // ignore . and ..
	//if(is_dir($logPath.$log)){}
	//echo $log .": ". is_dir($logPath.$log) ."\n";
 
  $logList[]=$log;
 }
 foreach($logList as $log){
 	echo "<option value='". $log ."'>". $log ."</option>\n";
 }
*/
	break;
}

//exec("sudo ./logs.sh $act $log $lines '$find'",$out);

?>

