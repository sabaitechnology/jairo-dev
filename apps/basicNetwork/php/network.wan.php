<?php
 header('Content-type: text/ecmascript');

 $wanType = $_REQUEST['wanType'];
 switch($wanType){
  case 'dhcp':
   $wanConfig = <<<wanConfig
iface $wanif inet dhcp
 hostname $wanHostname
 leasetime $wanLease
 hwaddress $wanMac
wanConfig
;
  break;
  case 'static':
   $wanConfig = <<<wanConfig
iface $wanif inet static
 address $wanip
 netmask $wanMask
 gateway $wanGateway
 mtu $wanmtu
 hwaddress $wanMac
wanConfig
;
  break;
  case 'onlan':
  case 'disabled':
  break;
  default:
   exit(0);
 }

$lanConfig = <<<lanConfig
iface $lanif inet static 
  bridge_ports $lanifs
  address $lanip
  netmask $lanMask
  broadcast $lanBroadcast
  gateway $lanGateway
##
#  bridge_stp off
##
# pre-up iwconfig wlan0 essid $YOUR_ESSID
# bridge_hw $MAC_ADDRESS_OF_YOUR_WIRELESS_CARD

lanConfig
;

?>
