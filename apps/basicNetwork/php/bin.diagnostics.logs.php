<?php
 if (!headers_sent()){ header('Content-type: text/ecmascript'); }
 $logPath = '/var/log/';

function getLogs($path = '/var/log/'){
 $logs = scandir($path);
 $logList = array();
 sort($logs, SORT_NATURAL | SORT_FLAG_CASE);
 foreach($logs as $log){
  if($log=='.' || $log=='..') continue; // ignore . and ..
  if(is_dir($path.$log)){
   $logList[]=array( $log => getLogs($path.$log) );
  }else{
   $logList[]=$log;
  }
 }
// sort($logList, SORT_NATURAL);
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

$isZipped = ( pathinfo($path, PATHINFO_EXTENSION) == 'gz' );

switch ($act) {
	case 'all':
		if ($isZipped){
			exec("gunzip -c $validPath", $out);
			echo implode("\n",$out);
		}else{
			readfile($validPath);	
		}
	break;

	case 'first':
		exec( ( $isZipped ? "gunzip -c $validPath | head -n $lines" : "head -n $lines $validPath" ), $out);
		echo implode("\n",$out);
	break;

	case 'last':
		exec( ( $isZipped ? "gunzip -c $validPath | tail -n $lines" : "tail -n $lines $validPath" ), $out);
		echo implode("\n",$out);
	break;

	case 'find':
		exec( ( $isZipped ? "gunzip -c $validPath | grep '$find'" : "grep '$find' $validPath" ), $out);
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

