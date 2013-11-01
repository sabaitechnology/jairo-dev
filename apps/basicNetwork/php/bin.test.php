<?php
 header('Content-type: text/ecmascript');
// include('bin.sys.php');

// var_dump( $GLOBALS );

// echo JSON_encode( $_REQUEST['new']);//, JSON_PRETTY_PRINT );
function writeConfig($config){
 return file_put_contents(__DIR__.'/../etc.js.new', $config ,LOCK_EX);
}

function normalizeConfiguration(){
	$etc = file_get_contents(__DIR__.'/../etc.js');
	$conf = json_decode($etc);
	$confContent = str_replace('    ',"\t", json_encode( $conf, JSON_PRETTY_PRINT ) );
	echo ( writeConfig($confContent) ? 'Rewritten' : 'Error' );
//	echo (file_put_contents(__DIR__.'/../etc.new.js', json_encode( json_decode(file_get_contents(__DIR__.'/../etc.js')), JSON_PRETTY_PRINT ) ,LOCK_EX)) ? 'Rewritten' : 'Error';
}

normalizeConfiguration();

//$etc = file_get_contents(__DIR__.'/../etc.js');

//echo $etc;

//$conf = json_decode($etc);
/*
$constants = get_defined_constants(true);
$json_errors = array();
foreach ($constants["json"] as $name => $value) {
    if (!strncmp($name, "JSON_ERROR_", 11)) {
        $json_errors[$value] = $name;
    }
}
*/
//var_dump($json_errors);

//var_dump(json_last_error());

//$confContent = json_encode( $conf, JSON_PRETTY_PRINT );

//echo $confContent;

?>
