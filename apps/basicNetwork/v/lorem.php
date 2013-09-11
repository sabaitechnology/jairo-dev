<?php
 echo "<div class='pageTitle'>". $panel .': '. $section ."\n\n";
 echo preg_replace(
  array("/^/m","/\n/m"),
  array(
   "<div class='controlBox'><span class='controlBoxTitle'>Lorem Ipsum</span><div class='controlBoxContent'>",
   "</div></div>\n\n"),
  file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/libs/lorem.txt')
 );

?>

