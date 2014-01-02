<!-- TODO: persistent data-->
<div class='pageTitle'>VPN: Clients</div>

<br>

<div>BEGIN</div>
<div id="vpn_clients"></div>

<pre id="testing"></pre>
<div>END</div>

<style type='text/css'>
.jai-widgetlist {
	width: 90%;
	border: 1px solid black;
	border-radius: 4px;
	padding: 0;
}
.jai-widgetlist > li {
	display: inline-block;
	width: 100%;
	/*margin: 0px 1em;*/
/*	padding: 0;
	margin: 0;
*/
	list-style-type: none;
}

.jai-vpnclient {
	padding: .25em 1em;
	border: 1px solid silver;
	border-radius: 4px;
}

.jai-vpnclient-name {
	display: inline-block;
	min-width: 20%;
	font-size: 1.25em;
	color: slategray;
	font-weight: bold;

}

.jai-vpnclient-state {
	display: inline-block;
	margin-left: 20%;
}

.inlineButton {
	margin: 0 .15em;
}



</style>
<script type='text/ecmascript' src='js/globalize.js'></script>
<script type='text/ecmascript' src='php/etc.php?q=pptp'></script>
<script type='text/ecmascript'>

// To create a jQuery Widget we invoke the widget constructor $.widget
// It takes three arguments:
//		- the widget we're creating ("jai.widgetlist" in this case)
//		- the base widget it inherits from (can be "jQuery.Widget", the generic widget)
//		- the prototype, which is the object those properties override the base

$.widget("jai.widgetlist", $.ui.sortable, {

// _create should minimally:
//		- set any necessary CSS classes on existing HTML elements
//			(all css that can be written in an external file should be;
//			 only dynamic properties like display should be directly set)
//		- create or prepare the base HTML element: for instance, if the base is a table and the element
//			on which the constructor is called is a div, the constructor should create a table inside the div
//			and set that table as the widget's element; but if called on a table, it should treat that table
//			as the widget's element, not create a table inside of it
//		- fully construct the internal HTML of the widget
//		- attach any event listeners for HTML elements
//		- attach and initialize any data for the widget using jQuery's $(element).data() function (http://api.jquery.com/data/)
	_create: function(){
//	the base element for our list is a ul, so if we are passed another type of element we
//		- create a ul in it
//		- reassign the element's id and rename the element with a new id
//		- call our widget's constructor on that
		if(!$(this.element).is("ul")){
			var baseElementID = $(this.element).attr('id');
			var baseElement = document.createElement('ul');
			$(this.element).append(baseElement).attr('id', baseElementID +'-base');
			$(baseElement).attr('id', baseElementID).widgetlist(this.options);
		}else{
//	apply the widgetlist style
			this.element.addClass('jai-widgetlist');
// //	store a local copy of the element's id for later use (this will come in handy later)
//			this.options.fid = this.element.attr('id');
			if(this.options.makeItem){
				this.makeItem = this.options.makeItem;
			}
//	now we add an item for each element of the list
			$.map(this.options.list, this.makeItem, this )

//	this widget inherits from ui.sortable, so we need to call its constructor to finish up
			this._super();
		}
	},
//	the default function for adding an item
//	 this function builds an item for the list; we will modify it for most lists
//	 by default it creates a widget for each element of the list,
//	  treating each element as the options for the widget
	makeItem: function(item, index, parentWidget){
		if(!parentWidget.options.widgetType){
			$(document.createElement('li'))
				.appendTo(parentWidget.element)
				.append(JSON.stringify(item))
		}else{
			$(document.createElement('li'))
				.appendTo(parentWidget.element)
				[parentWidget.options.widgetType](item);			
		}
	}
// 	addItem: function(item,index,parentWidget){
// 		var listItem = $(document.createElement('li')).appendTo(parentWidget);

// 		// $(parentWidget.element).append(
// 		// 	$(document.createElement('li')).append(parentWidget.makeItem(item, index, ))
// 		// );

// //		$(this.element).append( this.makeItem(item) );
// 	}

});

$.widget("jai.vpnclient", {
	_create: function(){
		this.element
		.append( $(document.createElement('div')).addClass('jai-vpnclient')
			.append( $(document.createElement('span')).addClass('jai-vpnclient-name').html(this.options.name) )
			.append( $(document.createElement('span')).addClass('jai-vpnclient-state').html('State').prop("id",this.options.name+"_info") )
			.append( $(document.createElement('span')).addClass('fright')
				.append( $(document.createElement('input')).addClass('inlineButton').prop("type","button").val("Connect") )
				.append( $(document.createElement('input')).addClass('inlineButton').prop("type","button").val("Edit") )
			)
		)
	}
})

	//do this on document load
	$(function(){
		$('#vpn_clients').widgetlist({ list: pptp, widgetType: "vpnclient"
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

