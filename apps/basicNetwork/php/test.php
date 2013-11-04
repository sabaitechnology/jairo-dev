<?php
 header('Content-type: text/ecmascript');

// var_dump( $GLOBALS );

// echo JSON_encode( $_REQUEST['new']);//, JSON_PRETTY_PRINT );
function writeConfig($config){
 return file_put_contents(__DIR__.'/../etc.js.new', $config, LOCK_EX);
}

function normalizeConfiguration(){
	$etc = file_get_contents(__DIR__.'/../etc.js');
	$conf = json_decode($etc);
	$confContent = str_replace('    ',"\t", json_encode( $conf, JSON_PRETTY_PRINT ) );
	echo ( writeConfig($confContent) ? 'Rewritten' : 'Error' );
//	echo (file_put_contents(__DIR__.'/../etc.new.js', json_encode( json_decode(file_get_contents(__DIR__.'/../etc.js')), JSON_PRETTY_PRINT ) ,LOCK_EX)) ? 'Rewritten' : 'Error';
}

function singleTime($mtime){
	$mtime = explode(" ", $mtime);
	return $mtime[1] + $mtime[0];
}

function compTimes($first, $second){
	$first = singleTime($first); $second = singleTime($second);
	return "I: ". $first ."\nE: ". $second ."\nS: ". ($second - $first) ."\n";
}

//normalizeConfiguration();
function writeBigConfig($size){
	$c = json_decode(file_get_contents(__DIR__.'/../etc.js'));
	$testobj = array();
	for($j=0; $j < $size; $j++){
		$testobj[ substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 10) ] = $c;
	}
	file_put_contents('/tmp/jaiconftest.js', json_encode($testobj, JSON_PRETTY_PRINT));
}

function testReadConfig($size){
	$i=$size;
	$start = microtime();
	while($i-- > 0){
		$conf = json_decode(file_get_contents('/tmp/jaiconftest.js'));
	}
	$end = microtime();
	echo compTimes($start, $end);
}

//writeBigConfig(100);

//testReadConfig(100);


?>
