<style type='text/css'>

.shortInput { width: 2.5em; }
.longInput { width: 50%; }
#act { margin-top: 5px; }

#logContents { width: 99%; height: 40em; }


#listContainer {
 position: relative;
 display: inline-block;
 border: 1px solid transparent;
 width: 25%;
 margin: .25em .5em 0 0;
}

#currentLog {
 display: inline-block;
 padding: .1em .5em;
/* cursor: pointer;*/
}

#currentLog, .dirlist > li, .dir { cursor: pointer; }

#listRoot {
 width: 100%;
 display: none;
 background: white;
 border: 1px solid black;
 float: left;
/* margin: 0 0 0 -1px;*/
 margin: 0;
/* cursor: pointer;*/
 text-indent: 0;
 padding: .1em 0;
 list-style-type: none;
 z-index: 2;
 position: absolute;
}
.dirlist > li { padding: 0 .5em; }
.dirlist > li:hover { background-color: yellow; }
.dirlist > li.sublist:hover { background-color: silver; }

.dir {
	display: inline-block;
	width: 100%;
}

.directory {
 display: none;
 text-indent: 0;
 margin: 0;
 padding-left: 0;
 list-style-type: none;
}
.directory > li {
 padding-left: 1em;
}

.closed:before { content: "+ "; }
.open:before { content: "- "; }

#goButton { float: right; }

</style>

<div class='pageTitle'>Diagnostics: Logs</div>

<div class='controlBox'>
	<span class='controlBoxTitle'>Logs</span>
	<div class='controlBoxContent'>
		<input id="log" name="log" type="hidden">
<!-- ?php include("php/diagnostics.logs.php"); ? -->

<div id="listContainer">

<span id="currentLog" onclick='showLogSelect();'></span>

<ul id="listRoot" class='dirlist'>
	<li>alternatives.log</li>
	<li>alternatives.log.1</li>
	<li class='sublist'>
	<span class='dir closed' id='title-var-log-apache2' rel='var-log-apache2'>/apache2/</span><ul class='dirlist directory' id='var-log-apache2'>
		<li>access.log</li>
		<li>error.log</li>
		<li>error.log.1</li>
	</ul>
	</li>
	<li>apport.log</li>
	<li>auth.log</li>
	<li>dmesg</li>
	<li>dmesg.0</li>
	<li>dpkg.log</li>
	<li>jockey.log</li>
	<li>kern.log</li>
	<li>syslog</li>
</ul>

</div>
	 	<select id='act' name='act' onchange="toggleDetail();">
	 		<option value='all'>View all</option>
	 		<option value='head'>View first</option>
	 		<option value='tail'>View last</option>
	 		<option value='grep' selected>Search for</option>
	 		<option value='download'>Download file</option>
	 	</select>
		<input type="text" name='detail' id='detail'><span id='detailSuffix'></span>
		<input id='goButton' type="button" value="Go" onclick="goLog();">

		<textarea id='logContents' readonly></textarea>
	</div>
</div>
<div>

</div>

<script type='text/javascript'>

function goLog(n){
	if($("#act").val() == "download"){
		alert("DOWNLOAD FILE");
	}else{
		$.ajax("php/diagnostics.logs.php", {
			success: function(o){ $('#logContents').html(o); },
			dataType: "text",
			data: $("#fe").serialize()
		});
	}
}

function catchEnter(event){ if(event.keyCode==13) goLog(); }
function toggleDetail(){
	$('#detailSuffix').html('');
	switch($('#act').val()){
		case 'all':
		case 'download':
			$('#detail').hide();
		break;
		case 'head':
		case 'tail':
			$('#detail').show().removeClass('longInput').addClass('shortInput').val('25');
			$('#detailSuffix').html(' lines');
		break;
		case 'grep':
			$('#detail').show().removeClass('shortInput').addClass('longInput').val('');
			break;
	}
}

function toggleContentList(event){
	$(this).toggleClass("closed open")
	$('#'+ $(this).attr('rel') ).slideToggle();
}

function setLogValue(logName){
	$('#log').val(logName);
	$('#currentLog').html(logName);
}

function getLogSelected(e){ var ep = $(e).parent(); var epi = $(ep).attr('id');
	return ( ( $(ep).attr('id') == 'listRoot' ) ? '' : ( getLogSelected( $(ep).parent() ) + $( '#title-' + $(ep).attr('id') ).html() ) ) + ($(e).hasClass('sublist') ? '' : $(e).html());
}

function showLogSelect(){ $('#listRoot').slideDown('fast'); }

function hideLogSelect(){
	setLogValue( getLogSelected( this ) );
	$('#listRoot').slideUp('fast');
}

$(function(){
 $('#detail').on("keydown", catchEnter);
 $('.dir').on("click", toggleContentList);
 $('#listRoot li').not('.sublist').on("click", hideLogSelect);
 setLogValue('syslog');
 toggleDetail();
});

/*
function show(){ $('#tooltip').show(); }
function hide(){ $('#tooltip').hide(); }
function displayInline(){ if($('#inlineHelp').is(':checked')){ $('.inlineHelp').show(); }else { $('.inlineHelp').hide(); } }
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
*/



//Uncomment for spinner - functional but does not match drop down
// $('#lines').spinner({ min: 0, max: 1000 }).spinner('value',25);
</script>
