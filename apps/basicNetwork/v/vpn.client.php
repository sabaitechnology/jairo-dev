<!-- TODO: persistent data-->
<div class='pageTitle'>VPN: Clients</div>

<br>
<div id="vpn_clients">
<!-- filled with accordion plugin + ajax request-->
</div>


<link rel="stylesheet" href="/libs/jquery-ui.min.css" />
<style type='text/css'>
.slideList {
	width: 80%;
	border: 1px solid black;
	border-radius: 4px;
	padding-right: 2px;
}
.slideListContent {
	padding: .25em 1em;
}
.slideListRow {
	display: inline-block;
	width: 100%;
	border: 1px solid silver;
	border-radius: 4px;
	/*margin: 0px 1em;*/
}
.slideListRowTitle {
	display: inline-block;
	min-width: 20%;
	font-size: 1.25em;
	color: slategray;
	font-weight: bold;

}

.slideListRowInfo {
	display: inline-block;
	margin-left: 20%;
}

.inlineButton {
	margin-left: .3em;
}



</style>
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>
<script type='text/ecmascript' src='js/globalize.js'></script>
<script type='text/ecmascript' src='php/etc.php?q=pptp'></script>
<script type='text/ecmascript'>

function makeSlideListRowHere(e){
	return $(document.createElement('div')).addClass('slideListRow')
		.append( $(document.createElement('div')).addClass('slideListContent')
			.append( $(document.createElement('span')).addClass('slideListRowTitle').html(e.name) )
			.append( $(document.createElement('span')).addClass('slideListRowInfo').html('State').prop("id",e.name+"_info") )
			.append( $(document.createElement('span')).addClass('fright')
				.append( $(document.createElement('input')).addClass('inlineButton').prop("type","button").val("Connect") )
				.append( $(document.createElement('input')).addClass('inlineButton').prop("type","button").val("Edit") )
			)
		)

// 	return 
//'<div class="slideListRow"><div class="slideListContent">'
// 	+'<span class="slideListRowTitle">'+ e.name +'</span>'
// 	+'<span class="slideListRowInfo" id="'+ e.name +'_info">State</span>'
// 	+'<span class="fright">'
// 	+'	<input type="button" class="inlineButton" value="Connect">'
// 	+'	<input type="button" class="inlineButton" value="Edit">
//	</span>'
// //	+ e.server +' | '+ e.user +' | '+ e.password
// 	+'</div></div>'
}

function makeSlideList(slideListElement, slideList, makeSlideListRow){
//	$(slideListElement).append("<div class='slideList'>\n")
	$(slideListElement).addClass("slideList")
	$.each(slideList, function(index, slideListMember){ $(slideListElement).append(makeSlideListRow(slideListMember)) });
//$(slideListElement).append();

//	$(slideListElement).append("</div>")
}

// 	function makeAccordion(accordionElement,accordionList) {
// 		for(i=0; i<accordionList.length; i++){
// 			$('#vpn_clients').append("<h3 class='vpn_client_"+ accordionList[i].name + "'>" + accordionList[i].name + "</h3>"
// +"<div class='ui-accordion-content vpn_client_"+ accordionList[i].name + "'>"
// +"<table class='controlTable'><tbody>"
// +"<tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + accordionList[i].name + "'></td></tr>"
// +"<tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+accordionList[i].server +"></td></tr>"
// +"<tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+accordionList[i].user +" ></td></tr>"
// +"<tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+accordionList[i].password +" ></td></tr>"
// +"</tbody></table><br>"
// +"<input type='button' value='Connect' name='connect' class='connect' >"
// +"<input type='button' value='Disconnect' name='disconnect' class='disconnect'>"
// +"<input type='button' value='Save' name='save_edit' class='save_edit'></div>"
// 			)
// 		}

// //		$(accordionElement).accordion({ collapsible: true });
// 	}

	//do this on document load
	$(function() {
//		makeAccordion("#vpn_clients",pptp);
		makeSlideList("#vpn_clients", pptp, makeSlideListRowHere);
// 		makeSlideList("#vpn_clients", pptp, function(e){
// return "<h3 class='vpn_client_"+ e.name + "'>" + e.name + "</h3>"
// +"<div class='ui-accordion-content vpn_client_"+ e.name + "'>"
// +"<table class='controlTable'><tbody>"
// +"<tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + e.name + "'></td></tr>"
// +"<tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+e.server +"></td></tr>"
// +"<tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+ e.user +" ></td></tr>"
// +"<tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+ e.password +" ></td></tr>"
// +"</tbody></table><br>"
// +"<input type='button' value='Connect' name='connect' class='connect' >"
// +"<input type='button' value='Disconnect' name='disconnect' class='disconnect'>"
// +"<input type='button' value='Save' name='save_edit' class='save_edit'></div>"

// 		});

		$('input[type=password]').each(function(i, e){
			$(e).focus(function(){ $(this).prop('type', 'text'); })
			$(e).blur(function(){ $(this).prop('type', 'password'); })
//			$(e).keydown(function(event){ if(event.keyCode == 13){ $(this).prop('type', 'password'); } })
		});

	});

	$('#vpn_clients').on('click', '.save_edit', function(){
		//get active record
		n = $("#vpn_clients h3").index($("#vpn_clients h3.ui-state-active"));
		var inputArr = $("#vpn_clients :input" ).serializeArray()
		$('#vpn_clients').html('');
		//every 4th value starts a new set
		for(i=0; i<inputArr.length; i=i+4){

			var id = Math.floor(Math.random() * 10000);
			if(inputArr[i].value.length == 0){
				$('#vpn_clients').append("<h3 class='"+ id + "'>" + inputArr[i+1].value + "</h3>")
			}else{
				$('#vpn_clients').append("<h3>" + inputArr[i].value + "</h3>")
			}
		$('#vpn_clients').append("<div class='ui-vpn_clients-content "+ id + "'><table id='"+ id + "' class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + inputArr[i].value + "'></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+inputArr[i+1].value +"></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+inputArr[i+2].value +" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+inputArr[i+3].value +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
		}

//		toServer('Save this.');
		$('#vpn_clients').accord("refresh").accord({active: n, static: false}); 

	})


	$('#vpn_clients').on('click', '.delete', function(){
		myid=$(this).parent().attr("class").match(/\d+/)
		$('.' + myid).remove();
		$('#vpn_clients').accord("refresh").accord({active:false, static: false});
	})


	function addNew() {
		var id = Math.floor(Math.random() * 10000);
		$('#vpn_clients').append("<h3 class='"+ id + "'>(New Item)</h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value=''></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value='' ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
		$('#vpn_clients').accord("refresh").accord("newItem").accord({ active: -1, static: false}); 
	}


</script>

