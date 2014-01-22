<?php

# Currently this file just accumulates all the files included in it
# Later, we may want to cache them or do some other wizardry

header("Content-Type: text/ecmascript");

echo implode(
	"\n\n",
	array_map(
		function($v){
			return file_get_contents("libs/". $v);
		},
		array(
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
		)
	)
);

?>