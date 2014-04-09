<?php

# Currently this file just accumulates all the files included in it
# Later, we may want to cache them or do some other wizardry

function dumpJavaScript($lib,$found){
	header("Content-Type: text/javascript; charset=utf-8");
	if($found){
		echo "/* BEGIN $v */\n";
		readfile("libs/".$v);
		echo "/* END $v */\n\n";
	}else{
		echo "/* ". $lib ." not found. */\n";
	}
}

function insertJavascriptTag($lib,$found){
	echo ( $found ? ("<script src=\"". $lib ."\"></script>\n") : ("<!-- ". $lib ." not found. -->\n") );
}

function insertRoClient(){
	$roo=json_decode(file_get_contents( __DIR__ . "/ro.options.json"));
	if(gettype($roo) != "NULL"){
		$roourl = "http". ($roo->ssl ? "s" : "") ."://". $roo->host .":". $roo->port;
		echo "<script src=\"$roourl/socket.io/socket.io.js\"></script>\n";
		echo "<script>\nvar ro = new Ro(\"$roourl\");\n</script>\n";
	}
}

function insertLibs($libs){
	foreach($libs as $libFile){
		// dumpJavaScript("/libs/". $libFile,file_exists("libs/".$libFile));
		insertJavascriptTag("/libs/". $libFile,file_exists($_SERVER['DOCUMENT_ROOT'] ."/libs/". $libFile));
	}
}

insertLibs(array(
	"jquery.js",
	"jqueryui.js",
	"jquery.mousewheel.js",
	"datatables.js",
	"jeditable.js",
	"noty.js",
	"jquery.noty.jai.js",
	"math.js",
	"jai-widgets.js",
	"jai.js",
	"wallawalla.js"
));
insertRoClient();
// header("Content-Type: text/javascript; charset=utf-8");

// echo $_SERVER['DOCUMENT_ROOT'] ."\n";

// var_dump(scandir($_SERVER['DOCUMENT_ROOT'] ."/libs/"));

?>