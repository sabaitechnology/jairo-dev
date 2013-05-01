<?php
 echo "<div class='controlBox'><h2>". basename(__FILE__) ."</h2></div>\n";
 echo preg_replace(
  array("/^/m","/\n/m"),
  array("<div class='controlBox'>","</div>\n"),
  file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/libs/lorem.txt')
 );
?>

