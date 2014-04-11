<?php
header('Content-type: text/ecmascript');
 
function getConf($q, $debug){
	foreach(explode(',','sys,'. $q) as $i){
		if(file_exists(__DIR__.'/../etc/'.$i)){
			if($debug){
				echo "/* $i exists */\n". $i .' = '. json_encode(json_decode(file_get_contents(__DIR__.'/../etc/'.$i)), JSON_PRETTY_PRINT);
			}else{
				echo $i .' = ';
				readfile(__DIR__.'/../etc/'.$i); //. json_encode($conf->$i, ($debug) ? JSON_PRETTY_PRINT : null ) .";\n";
			}
			echo ";\n";
		}else if($debug){
			echo "/* Error: $i doesn't exist. */\n";
		}
	}
}

if(array_key_exists('time',$_REQUEST)){
	echo 'now = '. json_encode(explode(',',date("Y,n,j,g,i,A"))) .";\n";
}

if(array_key_exists('q',$_REQUEST)) getConf($_REQUEST['q'], array_key_exists('debug',$_REQUEST));

?>
