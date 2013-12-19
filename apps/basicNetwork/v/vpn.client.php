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

$.widget( "jai.editablelist", $.ui.sortable, {
 _create: function(){
  this.element.addClass('editableList');
  this.options.fid = this.element.attr('id');
  this.addItems(this.options.list);
  if(!this.options.fixed) $(this.element).after("<br><input type='button' value='Add' onclick='$(\"#"+ this.options.fid +"\").editablelist(\"addItems\")'>");
  this._super();
 },
 addItems: function(a){ if(a==null) a = false;
  var fid = this.options.fid;
  var fixed = this.options.fixed;
  $(this.element).addClass("editableList");
  $(this.element).append( $.map( ( a||[''] ),function(v,i){
    return $(document.createElement('li'))
    .append( $(document.createElement('input')).addClass("editableFormComplement").prop("type","hidden").prop("name",fid+"[]").val(v) )
    .append( $(document.createElement('span')).addClass("editableListText").html(v) )
    .append( (fixed ? null : $(document.createElement('a').addClass("deleteX").html("X")) ) )
  }));
  if(!fixed) $(this.element).find('.deleteX').click(function(event){ $(event.target).parent().remove(); });
  $(this.element).find('.editableListText').editable(function(value, settings){
    if(!fixed) if(value==''){ $(this).parent().remove(); };
    $(this).siblings('.editableFormComplement').val(value);
    return value;
   },{ 'onblur': 'submit', 'event': 'dblclick', placeholder: '(Double click to edit.)' }
  );
  if($(this.element).data('sortable')) $(this.element).sortable('refresh');
  if(!a) $(this.element).last().children().last().children('.editableListText').trigger('dblclick');
 },
 options: {
  forcePlaceholderSize: true,
  forceHelperSize: true,
  placeholder: "editableListPlaceholder",
  items: "li:not(.listBookend)",
 }
});


function makeSlideListRowHere(e,i){
	return $(document.createElement('div')).addClass('slideListRow')
		.append( $(document.createElement('div')).addClass('slideListContent')
			.append( $(document.createElement('span')).addClass('slideListRowTitle').html(e.name) )
			.append( $(document.createElement('span')).addClass('slideListRowInfo').html('State').prop("id",e.name+"_info") )
			.append( $(document.createElement('span')).addClass('fright')
				.append( $(document.createElement('input')).addClass('inlineButton').prop("type","button").val("Connect") )
				.append( $(document.createElement('input')).addClass('inlineButton').prop("type","button").val("Edit") )
			)
		)

}

function makeSlideList(slideListElement, slideList, makeSlideListRow){
	$(slideListElement).addClass("slideList")
	$(slideListElement).append( $.map( (slideList||['']), makeSlideListRow ));
	// $(this.element).append( $.map( slideList, function(e,i){
	// 	return $(document.createElement('div')).html('Text!')
	// } ));
//	$.each(slideList, function(index, slideListMember){ $(slideListElement).append(makeSlideListRow(slideListMember)) });

}

	//do this on document load
	$(function(){
		makeSlideList("#vpn_clients", pptp, makeSlideListRowHere);

		$('input[type=password]').each(function(i, e){
			$(e).focus(function(){ $(this).prop('type', 'text'); })
			$(e).blur(function(){ $(this).prop('type', 'password'); })
//			$(e).keydown(function(event){ if(event.keyCode == 13){ $(this).prop('type', 'password'); } })
		});

	});

// 	$('#vpn_clients').on('click', '.save_edit', function(){
// 		//get active record
// 		n = $("#vpn_clients h3").index($("#vpn_clients h3.ui-state-active"));
// 		var inputArr = $("#vpn_clients :input" ).serializeArray()
// 		$('#vpn_clients').html('');
// 		//every 4th value starts a new set
// 		for(i=0; i<inputArr.length; i=i+4){

// 			var id = Math.floor(Math.random() * 10000);
// 			if(inputArr[i].value.length == 0){
// 				$('#vpn_clients').append("<h3 class='"+ id + "'>" + inputArr[i+1].value + "</h3>")
// 			}else{
// 				$('#vpn_clients').append("<h3>" + inputArr[i].value + "</h3>")
// 			}
// 		$('#vpn_clients').append("<div class='ui-vpn_clients-content "+ id + "'><table id='"+ id + "' class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + inputArr[i].value + "'></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+inputArr[i+1].value +"></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+inputArr[i+2].value +" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+inputArr[i+3].value +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
// 		}

// //		toServer('Save this.');
// 		$('#vpn_clients').accord("refresh").accord({active: n, static: false}); 

// 	})


// 	$('#vpn_clients').on('click', '.delete', function(){
// 		myid=$(this).parent().attr("class").match(/\d+/)
// 		$('.' + myid).remove();
// 		$('#vpn_clients').accord("refresh").accord({active:false, static: false});
// 	})


// 	function addNew() {
// 		var id = Math.floor(Math.random() * 10000);
// 		$('#vpn_clients').append("<h3 class='"+ id + "'>(New Item)</h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value=''></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value='' ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
// 		$('#vpn_clients').accord("refresh").accord("newItem").accord({ active: -1, static: false}); 
// 	}


</script>

