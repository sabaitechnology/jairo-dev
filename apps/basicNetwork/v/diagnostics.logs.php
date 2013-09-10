<!-- style type='text/css'>
.tablemenu { width: 100%; border: 1px transparent double !important; border-collapse: collapse; }
.tablemenu td { border: 1px black solid; text-align: center; }
#log { width:200px; margin-left:5px; background:#FFF; }
#lines { background:#FFF; }
#findText { position: relative; top: -1px; }
#response { width: 100%; height: 480px; margin-top:2px; box-shadow: .3px .3px .3px .3px inset; background:#FFF; }
.pointy { cursor: pointer; }
</style -->

<div class='pageTitle'>Diagnostics: Logs</div>

<div class='controlBox'>
    <span class='controlBoxTitle'>Logs</span>
     <div class='controlBoxContent'>

			<input type='hidden' name='act' id='act' value='all'>

			<table class='tablemenu'>
			<tbody>
				<tr><td>
				 <a onclick="getLog('last');" class="pointy" href="#">
				 	View Last 
				 	<input onclick='return false;' class='shortinput' type="text" name='lines' id='lines' size='5' value='25' />
				  Lines</a> |
				</td>
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

					?></select>
				</td>
				<td> | <a onclick="getLog('all');" class="pointy" href='#'>View All</a> | </td>
				<td><input type="text" id='find' name='find' class='longinput'><input type="button" value="Find" onclick="getLog('find');" id='finder'></td>
				</tr>
			</tbody>
			</table>
			
			<textarea id='logContents' style="width: 90%; height: 30em" readonly></textarea>
	</div>
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


</script>
