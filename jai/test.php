<?php

header("Content-type: text/plain");

$n=1000;
while($n-->0){
	$m=100;
	while($m-->0){
		echo ".";
	}
	echo "\n";
	usleep(1000);
}

?>