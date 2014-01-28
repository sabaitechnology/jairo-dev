<?php

# Currently this file just accumulates all the files included in it
# Later, we may want to cache them or do some other wizardry

header("Content-Type: text/javascript; charset=utf-8");

foreach(array(
	"jquery.js",
	"jqueryui.js",
	"jquery.mousewheel.js",
	"datatables.js",
	"jeditable.js",
	"noty.js",
	"jquery.noty.jai.js",
	"math.js",
	"widgets.js",
	"jai.js"
) as $v){
	if(file_exists("libs/".$v)){
		echo "/* BEGIN $v */\n";
		readfile("libs/".$v);
		echo "/* END $v */\n\n";	
	}else{
		echo "/* $v NOT FOUND; check libs.php */\n\n";
	}
}

?>