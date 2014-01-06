<!-- TODO: persistent data-->
<div class='pageTitle'>VPN: Clients</div>

<br>

<div id="vpn_clients"></div>

<pre id="testing"></pre>

<style type='text/css'>
.jai-widgetlist {
	width: 95%;
	border: 1px solid black;
	border-radius: 4px;
	padding: 0;
}
.jai-widgetlist > li {
	display: inline-block;
	width: 100%;
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

.jai-vpnclient-editor {
	width: 100%;
	height: 5em;
	background: gray;
	display: none;
}

.inlineButton {
	margin: 0 .15em;
}

</style>
<script type='text/ecmascript' src='php/etc.php?q=vpnclients'></script>
<script type='text/ecmascript'>

// BEGIN Widget List

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
			var baseElementID = $(this.element).attr("id");
			var baseElement = document.createElement("ul");
			$(this.element).append(baseElement).attr("id", baseElementID +"-base");
			$(baseElement).attr("id", baseElementID).widgetlist(this.options);
		}else{
			var me = this.element.attr("id");
//	apply the widgetlist style
			this.element.addClass("jai-widgetlist");
			if(!this.options.fixed){
 				$(this.element).after(
 					$(document.createElement("input"))
 						.prop("type","button")
 						.val("Add")
 						.data("widgetListID",this.element.attr("id"))
 						.click(function(){
 							$("#"+ me).widgetlist("addItem");
 						})
 				);
			}
//	the default method for making a list item can be overridden if necessary
			if(this.options.makeItem) this.makeItem = this.options.makeItem;
//	now we add an item for each element of the list
			$.map(this.options.list, this.makeItem, this);
//	this widget inherits from ui.sortable, so we need to call its constructor to finish up
			this._super();
		}
	},
//	 this function builds an item for the list; we will modify it for most lists
//	 by default it creates a widget for each element of the list,
//	  treating each element as the options for the widget
//	Note: (important) All dependence between the widgetlist and the widgets in it
//	 should be contained in this function (ie, delete buttons and such)
//	 and the addItem function; this keeps the widgetlist widget definition clean
//	 and allows individual widgets in the list to manage their own deletion/editing
	makeItem: function(item, index, parentWidget){
		// Just create a straightforward list if no widget type is supplied.
		//  this will need fixed to create the normal editable list, perhaps with a default list item constructor
		if(!parentWidget.options.widgetType){
			$(document.createElement('li'))
				.appendTo(parentWidget.element)
				.append(JSON.stringify(item))
		}else{
//	We're passing the fixed option and parent element to the widget constructor
//	 so that it can add appropriate delete buttons and call the parent's refresh function
			$(document.createElement('li'))
				.appendTo(parentWidget.element)
//	the object element named in brackets here is the constructor for the widgets that make up the list
				[parentWidget.options.widgetType](
//	We merge the item object passed into makeItem with properties that allow us to interface with the parent widgetlist.
					$.extend(
						{
//	here we pass a refresh function for the parent widget as an anonymous function
//	this decouples the parent and child widgets
							parent: {
								refresh: function(){ $(parentWidget.element).widgetlist("refresh"); },
								fixed: parentWidget.options.fixed,
								type: "widgetlist",
								element: $(parentWidget.element).attr("id")
							},
							parentRefresh: function(){ $(parentWidget.element).widgetlist("refresh"); },
							parentFixed: parentWidget.options.fixed,
//	The only widget making use of widgetlist so far, vpnclient, doesn't use the following two properties
//	They are here for future use, and could be removed if not used
							parentType: "widgetlist",
							parentElementID: $(parentWidget.element).attr("id")
						},
						item
					)
				);
		}
	},
//	the default function for adding an item
 	addItem: function(){
		this.makeItem({ name: "New", editing: true },-1,this);
		this.refresh();
 	},
 	options: {
 		fixed: false,
 	}
});

// END Widget List

// BEGIN VPN Client Widget

$.widget("jai.vpnclient", jQuery.Widget,{
	_create: function(){
		this.options.idString = this.options.name.replace(" ","_");
		var widgetElementID = this.options.idString;

		if(this.options.parent !== "undefined") this.options.deletable = this.options.deletable && (!this.options.parent.fixed);
		if(this.options.editing && !this.options.name) this.options.name = "New Client";
		this.element
			.prop("id",this.options.idString)
			.append( $(document.createElement('div')).addClass('jai-vpnclient')
				.append(
					$(document.createElement('span'))
						.addClass('jai-vpnclient-name')
						.html(this.options.name)
				)
				.append(
					$(document.createElement('span'))
						.addClass('jai-vpnclient-state')
						.html('State')
						.prop("id",this.options.idString+"_info")
				)
				.append(
					controls = $(document.createElement('span'))
						.addClass('fright')
				)
			);
		$(controls)
			.append(
				$(document.createElement('input'))
					.attr("id", this.options.idString +"-connect")
					.addClass('inlineButton')
					.prop("type","button")
					.val("Connect")
			);
		if( this.options.editable ){
			$(document.createElement('input'))
				.appendTo(controls)
				.attr("id", this.options.idString +"-edit")
				.addClass('inlineButton')
				.prop("type","button")
				.val("Edit")
				.data("widgetID",this.options.idString)
//				.click(this.edit)
				.click(function(){ $("#"+ widgetElementID).vpnclient("edit"); })
			$(document.createElement('input'))
				.appendTo(controls)
				.attr("id", this.options.idString +"-save")
				.addClass('inlineButton')
				.prop("type","button")
				.val("Save")
				.data("widgetID",this.options.idString)
//				.click(this.save)
				.click(function(){ $("#"+ widgetElementID).vpnclient("save"); })
				.hide()
		}
		if( this.options.deletable ){
			$(document.createElement("input"))
				.appendTo(controls)
				.addClass("inlineButton")
				.prop("type","button")
				.val("Remove")
				.data("widgetID",this.options.idString)
				.click(this.removeFromList)
		}
		if(this.options.editing) this.edit();
	},
	edit: function(){
		$("#"+ this.options.idString +"-connect").hide();
		$("#"+ this.options.idString +"-edit").hide();
		$("#"+ this.options.idString +"-save").show();
//	if we have no yet constructed the editor, do it now
		if( !this.editor ){
			this.editor = $(document.createElement('div'))
				.appendTo( this.element )
				.addClass("jai-vpnclient-editor")
		}
		$(this.editor).slideDown();

	},
	save: function(){
		$("#"+ this.options.idString +"-connect").show();
		$("#"+ this.options.idString +"-edit").show();
		$("#"+ this.options.idString +"-save").hide();
		$(this.editor).slideUp();
		this.saveData();
	},
	saveData: function(){
	},
	removeFromList: function(){
		var mid = "#"+ $(this).data("widgetID");
		var postRefresh = $(mid).vpnclient("option","parentRefresh");
		$(mid).remove();
		postRefresh();

// TODO: needs to also delete this connection in the configuration file.

	},
	options: {
		parent: null,
		deletable: true,
		editable: true
	}
});

// END VPN Client Widget

$(function(){
	$('#vpn_clients').widgetlist({ list: vpnclients, widgetType: "vpnclient" });
});

</script>

