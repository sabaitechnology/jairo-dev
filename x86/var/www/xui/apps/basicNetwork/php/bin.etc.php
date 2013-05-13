<?php
 header('Content-type: text/ecmascript');

// $rtd = '/home/vaelyn/Dropbox/x86/x86'; // Default: ''
// $uiid = 'CADAEIC';

 $wanif = 'eth0';
 $lanif = 'br0';
 $lanifs = array('eth1','eth2','eth3','eth4','eth5'); 

//var_dump($GLOBALS);

 echo "?: ". $_REQUEST['what'] ."\n";

 switch($_REQUEST['what']){
  case 1:
   echo "1\n";
  case 2:
   echo "2\n";
  default:
   echo "0\n";
 }

?>
