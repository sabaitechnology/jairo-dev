<?php 
   
header('Content-type: text/ecmascript');

$output = array();
$datalines = array();
$dataResult = array();

//the -n here keeps it from trying to resolve the *'s
exec( 'netstat -r -n', $output);

$outputLength = count($output);

for ($i=2; $i<$outputLength; $i++){
	$string = trim($output[$i]);
	$line = preg_split("/\s+/",$string);
	array_push($datalines, $line); 
}

foreach($datalines as &$dl){
  $dataResult[] = array(
    'destination' => $dl[0],
    'gateway' => $dl[1],
    'genmask' => $dl[2],
    'flags' => $dl[3],
    'mss' => $dl[4],
    'window' => $dl[5],
    'irtt' => $dl[6],
    'interface' => $dl[7]
  );
}

$out = array(
  'routeResults' => $dataResult
);

echo json_encode($out,JSON_PRETTY_PRINT);

?>  