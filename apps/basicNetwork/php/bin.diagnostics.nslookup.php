<?php

	$lookupAddress=$_REQUEST['ns_domain'];
	
	$ip = gethostbynamel($lookupAddress);

	$addrs = count($ip) -1;

	echo("Returned $addrs addresses\n");

	for ($i = 0 ; $i < $addrs ; $i++)
        echo($ip[$i] . "\n");

?>