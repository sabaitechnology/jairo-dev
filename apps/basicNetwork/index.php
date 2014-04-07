<!DOCTYPE html><meta charset="utf-8"><html><head>
<title id="mainTitle">Sabai Jai Ro</title>

<link rel="stylesheet" type="text/css" href="/libs/jqueryui.css">
<link rel="stylesheet" type="text/css" href="/libs/jai-widgets.css">
<link rel="stylesheet" type="text/css" href="css/main.css">

<!-- socket.io
	We're making PHP give us a valid address for our server since this address will actually refer
	 to the machine we're running on, which is different everywhere.
-->
<!--
	TODO: resolve multiple inclusion of node.js ro service information
	We ought to only include this once and retrieve it in both the front end and the back end from one place.
	Currently it's all over the place.
-->
<!-- script src="/libs/ro.info.js"></script -->
<script src="http://<?php echo $_SERVER['HTTP_HOST']; ?>:31400/socket.io/socket.io.js"></script>
<!-- <script src="/libs.php"></script> -->
<?php include("./libs.php"); ?>
<script src="js/main.js"></script>
<script>
// noty settings -- moved to /libs/jquery.noty.jai.js
// jainode definition -- moved to /libs/jai.js
var ro = new Ro("http://<?php echo $_SERVER['HTTP_HOST']; ?>:31400");

function toggleHelpSection() {
	$( "#helpClose").show();
	$( "#helpSection" ).toggle( "slide", { direction: "right" }, 500 );
	$( "#helpButton" ).hide();
	return false;
};

function closeHelpSection() {
	$( "#helpClose").hide();
	$( "#helpSection" ).toggle( "slide", { direction: "right" }, 500 );
	$( "#helpButton" ).show();
	return false;
}

<?php
 $template = array_key_exists('t',$_REQUEST);
 $panel = ( array_key_exists('panel',$_REQUEST) ? preg_replace('/[^a-z\d]/i', '', $_REQUEST['panel']) : null );
 $section = ( array_key_exists('section',$_REQUEST) ? preg_replace('/[^a-z\d]/i', '', $_REQUEST['section']) : null );
 if( empty($panel) ){ $panel = 'network'; $section = 'wan'; }
 $page = ( $template ?'m':'v') ."/$panel". ( empty($section) ? '' : ".$section") .".php";
 if(!file_exists($page)) $page = 'v/lorem.php';
 echo "var template = ". ($template?'true':'false') ."; var panel = '$panel'; var section = '$section';\n";
?>

$(function(){
	$("#goToHelp").attr("href", "http://wiki.jairoproject.com" + location.search);
	$("#goToWiki").attr("href", "help.php" + location.search);
	$( "#helpButton" ).click(toggleHelpSection);
	$( "#helpClose").click(closeHelpSection)
});

</script>
</head><body>

<div id="backdrop">
	<?php include('menu.php'); ?>

	<div id="panelContainer">

		<div id="helpArea">
			<img id="helpButton" src="img/help.png">
			<div id="helpSection" class="ui-widget-content ui-corner-al">
		<!-- 		<a href="#" id="closeHelp" class="xsmallText fright">Close</a> -->
				Display Inline Help
				<a id="helpClose" class="noshow xsmallText" href="#">Close</a>
				<input name="inlineHelp" id="inlineHelp" type="checkbox" checked="checked"><br><br>
				<span style="text-decoration: underline">Links:</span><br>
				<a id="goToHelp" href="#">Help Page</a><br>
				<a id="goToWiki" href="#">Wiki Page</a>
			</div>
		</div>

		<div id="panel">
			<form id="fe">
			<?php include($page); ?>
			</form>
		</div>
	</div>
</div>

</body></html>
