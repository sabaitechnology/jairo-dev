<?php

	$lookupAddress=$_REQUEST['ns_domain'];
	
	// $ip = gethostbynamel($lookupAddress);

	exec("nslookup $lookupAddress", $ip);

	$addrs = count($ip);

	for ($i = 0 ; $i < $addrs ; $i++)
        echo($ip[$i] . "\n");

?>