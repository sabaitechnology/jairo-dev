<?php
header('Content-Type: application/javascript');

$lanIp=$_REQUEST['lanip'];
$lanMask=trim($_REQUEST['lanmask']);
$lanLease=trim($_REQUEST['dhcpLease']);
$networkAddress="192.168.1.0";
$broadcastAddress="192.168.1.255";
$dhcpLower=trim($_REQUEST['dhcpLower']);
$dhcpUpper=trim($_REQUEST['dhcpUpper']);
$dhcpToggle=trim($_REQUEST['dhcpToggle']);

$out = array();

exec("sudo ./lan.sh $lanIp $lanMask $lanLease $networkAddress $broadcastAddress $dhcpLower $dhcpUpper $dhcpToggle 2>&1", $out);

if(count($out) > 1){
	$out = str_replace('"', "'", implode($out, "\n"));
	echo '{ "sabai": false, "msg": "$out" }';
}else{
	echo $out[0];
}

#exec("set",$out);

#var_dump($out);

?>