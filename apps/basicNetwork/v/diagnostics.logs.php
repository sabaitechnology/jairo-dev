<!-- style type='text/css'>
.tablemenu { width: 100%; border: 1px transparent double !important; border-collapse: collapse; }
.tablemenu td { border: 1px black solid; text-align: center; }
#log { width:200px; margin-left:5px; background:#FFF; }
#lines { background:#FFF; }
#findText { position: relative; top: -1px; }
#response { width: 100%; height: 480px; margin-top:2px; box-shadow: .3px .3px .3px .3px inset; background:#FFF; }
.pointy { cursor: pointer; }
</style -->

<!-- Hidden tooltip - click ? to show -->
<div class='inline'>
 <div id='tooltip'>
	        <img class="callout" src="img/callout.gif" />
	      	<a href='#' class='fright xsmallText' onclick='hide();'>Close</a>
	        <p> 
	        <b>Display Inline Help: <input id='inlineHelp' type='checkbox' onClick='displayInline();'></input></b> 
	        <br> 
	        <b>Manual Page:</b> <a href="?panel=lorem" target="_blank">Logs</a>
	        <br>
	        <b>Links:</b> 
	        <a href="http://www.wikipedia.com" target="_blank">Wiki Page</a>
	        
	      	</p>
</div>
</div>

<div class='pageTitle'>Diagnostics: Logs 

	   
	<a href="#" id="question" onclick='show();'>
	    <img id='help' src="img/help.png" />
	</a>
	

</div>

<div class='controlBox'>
    <span class='controlBoxTitle'>Logs</span>
     <div class='controlBoxContent'>
     	<div id='error'></div>
			<input type='hidden' name='act' id='act' value='all'>

			<table class='tablemenu'>
			<tbody>
				<tr>
				<td>
					<select id='log' name='log'><?php
					// ** Possible strategy for encapsulation?
					//
					//include("php/bin.diagnostics.logs.php?act=list");

					// $logs = glob('/var/log/*.log');
					// $logs = glob('/var/log/*');

					 $logdir = '/var/log/';

					 $logs = scandir($logdir);
					 
					 $logList = array();

					 foreach($logs as $log){
						// ignore . and ..
					  if($log=='.' || $log=='..') continue;
						//if(is_dir($logdir.$log)){}
						//echo $log .": ". is_dir($logdir.$log) ."\n";
					 
					  $logList[]=$log;
					 }
					 foreach($logList as $log){
					 	echo "<option value='". $log ."'>". $log ."</option>\n";
					 }
						// var_dump($logs);

						// foreach(preg_replace(array("|/var/log/|","/\.log$/"),'',glob('/var/log/*.log')) as $lf) echo "<option value='". $lf ."'>". $lf ."</option>\n";

					?></select> |
				</td>
				<td id='linesDiv'>  
				 <a onclick="checkNum()" class="pointy" href="#">
				 	View Last 
				 	<input onclick='return false;' class='shortinput' type="text" name='lines' id='lines' size='5' value='25' />
				  Lines </a>
				<td> | <a onclick="getLog('all'); ignoreError()" class="pointy" href='#'>View All</a> | </td>
				<td><input type="text" id='find' name='find' class='longinput'><input type="button" value="Find" onclick="getLog('find');" id='finder'></td>
				</tr>
	<!-- 			<tr class='inlineHelp helpbox'>
					<td>I am helpful!
					</td>
	 -->			</tr>
			</tbody>
			</table>
			<div class='inlineHelp helpbox'>
				<p>I am helpful!</p>
			</div>

			
			<textarea id='logContents' style="width: 90%; height: 30em" readonly>
			</textarea>
		
	</div> <!-- end control box content -->
</div>
<div><input type='button' id='log' name='log' value='Download Log File' onclick="getLog('all');"></div>

<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/javascript'>

function getLog(n){
	$("#act").val(n);

	$.ajax("php/bin.diagnostics.logs.php", {
		success: function(o){
			$('#logContents').html(o);
		},
		dataType: "text",
		data: $("#fe").serialize()
	})
}

function catchEnter(event){ if(event.keyCode==13) getLog('find'); }

$(function(){ // hidden = $('#hideme'); hide = $('#hiddentext');
 $('#find').on("keydown", catchEnter);
})

function show(){
	$('#tooltip').show();
}
function hide(){
	$('#tooltip').hide();
}

function displayInline(){
	if($('#inlineHelp').is(':checked')){
		$('.inlineHelp').show();
	}else {
		$('.inlineHelp').hide();
	}

}

function checkNum(){
	console.log('blurred');
	var contents = $('#lines').val();
	console.log(contents)
	if($.isNumeric(contents)){
		console.log('numberic')
		$('#error').html('');
		$('#linesDiv').removeClass('errorInput')
		getLog('last');
	}else{
		console.log('not numberic')
		$('#error').html('<span style="color: red">Oops! Value must be a number</span>')
		$('#linesDiv').addClass('errorInput')
	}
}

function ignoreError(){
		$('#error').html('');
		$('#linesDiv').removeClass('errorInput')
}

</script>
