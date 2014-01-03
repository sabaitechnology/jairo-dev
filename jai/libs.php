<?php

$files = array(
	"libs/jai.js",
	"libs/jquery.js",
	"libs/jqueryui.js",
	"libs/jquery.mousewheel.js",
	"libs/datatables.js",
	"libs/jeditable.js",
	"libs/noty.js",
	"libs/jquery.noty.jai.js",
	"libs/math.js",
	"libs/widgets.js"
);

header("Content-Type: text/ecmascript");

//echo implode("\n\n", array_map("file_get_contents", $files) );

$newAccess=implode("", array_map("filemtime", $files));
if( (!file_exists("libs/jaiCache.js")) || (!file_exists("libs/jaiCache.date")) || ($newAccess!=file_get_contents("libs/jaiCache.date")) ){
	file_put_contents("libs/jaiCache.date", $newAccess);
	file_put_contents("libs/jaiCache.js", implode("\n\n", array_map("file_get_contents", $files) ) );
}

readfile("libs/jaiCache.js");

?>