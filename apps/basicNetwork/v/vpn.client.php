<div class='pageTitle'>VPN: Clients</div>
<br>
<div id="vpn_clients"></div>

<pre id="testing"></pre>

<script type='text/ecmascript' src='php/etc.php?q=vpnclients'></script>
<script type='text/ecmascript'>
// BEGIN Widget List
// To create a jQuery Widget we invoke the widget constructor $.widget; it takes three arguments:
	//	- the widget we're creating ("jai.widgetlist" in this case)
	//	- the base widget it inherits from (can be "jQuery.Widget", the generic widget)
	//	- the prototype, which is the object those properties override the base
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
	//	the default method for making a list item can be overridden if necessary
			if(this.options.makeItem) this.makeItem = this.options.makeItem;
	//	now we add an item for each element of the list
			$.map(this.options.list, this.makeItem, this);
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
					{
	//	here we pass a refresh function for the parent widget as an anonymous function
	//	this decouples the parent and child widgets
						parent: {
							refresh: function(){ $(parentWidget.element).widgetlist("refresh"); },
							fixed: parentWidget.options.fixed,
							type: "widgetlist",
							element: $(parentWidget.element).attr("id")
						},
						vpnclient: item
					}
				);
		}
	},
	//	the default function for adding an item
 	addItem: function(){
		this.makeItem(null,-1,this);
		this.refresh();
 	},
 	options: {
 		fixed: false,
 	}
});
// END Widget List

// BEGIN VPN Client Widget

$.widget("jai.vpnclient", $.Widget,{
	_create: function(){
		if(this.options.parent !== "undefined") this.options.deletable = this.options.deletable && (!this.options.parent.fixed);
		this.makeRow();
		if(!this.options.vpnclient){
			this.title.html(this.options.nameplaceholder);
			this.options.editing = true;
		}else{
			this.updateName();
		}
		if(this.options.editing) this.edit();
	},
	makeRow: function(){
		$(document.createElement('div'))
			.addClass('jai-vpnclient-container')
			.append(
				this.title = $(document.createElement('span'))
					.addClass('jai-vpnclient-name')
				,this.state = $(document.createElement('span'))
					.addClass('jai-vpnclient-state')
					.html('State')
				,this.controls = $(document.createElement('span'))
					.addClass('fright')
			)
			.appendTo(
				this.element
					.addClass('jai-vpnclient')
			);
		this.buttons = {};
		this.buttons.act = $(document.createElement('input'))
			.appendTo(this.controls)
			.addClass("inlineButton actButton")
			.prop("type","button")
			.val("Act")
			.data("parentWidget", this)
			.click(function(){ $(this).data("parentWidget").act(); })
		if( this.options.editable ){
			this.buttons.edit = $(document.createElement('input'))
				.appendTo(this.controls)
				.addClass("inlineButton editButton")
				.prop("type","button")
				.val("Edit")
				.data("parentWidget", this)
				.click(function(){ $(this).data("parentWidget").edit(); })
			this.buttons.save = $(document.createElement('input'))
				.appendTo(this.controls)
				.addClass("inlineButton saveButton")
				.prop("type","button")
				.val("Save")
				.data("parentWidget", this)
				.click(function(){ $(this).data("parentWidget").save(); })
				.hide()
		}
		if( this.options.deletable ){
			this.buttons.remove = $(document.createElement("input"))
				.appendTo(this.controls)
				.addClass("inlineButton removeButton")
				.prop("type","button")
				.val("Remove")
				.data("parentWidget", this)
				.click(function(){ $(this).data("parentWidget").removeFromList(); })
		}
	},
	updateName: function(){
		this.options.idString = this.options.vpnclient.name.replace(" ","_");
		this.element.attr("id",this.options.idString);
		this.title.html(this.options.vpnclient.name);
		this.state.attr("id",this.options.idString+"_info")
		$.map(this.buttons, function(v,i, widgetID){
			$(v).data("widgetID", widgetID);
		}, this.options.idString);
	},
	selectType: function(){
		if(!this.options.vpnclient) this.options.vpnclient = {};
		this.options.vpnclient.type = $("#vpnclienteditor-typeselector").val();
		$("#vpnclienteditor-typeselector-section").remove();
		this.edit();
	},
	edit: function(){
		this.buttons.act.hide();
		this.buttons.edit.hide();
// REMOVE AFTER CONSTRUCTION
//		$("#testing").append( "i: "+ JSON.stringify( this.options.vpnclient ) +"\n" )
		if(!this.options.vpnclient) this.options.vpnclient = { type :"pptp" };

// make sure we have a type
		if(!this.options.vpnclient || !this.options.vpnclient.type){
			$(document.createElement("div"))
				.attr("id", "vpnclienteditor-typeselector-section")
				.append(
					$(document.createElement("select"))
						.attr("id", "vpnclienteditor-typeselector")
						.append(
							$.map(this.options.supportedTypes, function(v,i){
								return $(document.createElement("option")).html(v)
							})
						)
					,$(document.createElement("input"))
						.attr("type", "button")
						.val("Select")
						.data("parentWidget", this)
						.click(function(){
							$(this).data("parentWidget").selectType();
						})
				)
				.appendTo(this.element)
		}else{
			this.buttons.save.show();
//	if we have not yet constructed the editor, do it now
			if( !this.editor ){
				// $("#testing").append( "1: "+ JSON.stringify( this.options.vpnclient ) +"\n" )
				this.editorID = "vpnclienteditor_"+ this.options.vpnclient.type;
				if($.jai[this.editorID]){
					this.editor = $(document.createElement('div'))
						.appendTo( this.element )
						[this.editorID]({ vpnclient: this.options.vpnclient });
				}else{
					$("#testing").append("\n!!! There is currently no editor for this type. Please fix this.\nRaw data: "+ JSON.stringify(this.options.vpnclient) +"\n")
				}
			}
			this.editor.slideDown();
		}
	},
	save: function(){
		this.buttons.act.show();
		this.buttons.edit.show();
		this.buttons.save.hide();
		this.saveData();
		$(this.editor).slideUp();
	},
	saveData: function(){
		// save this.getData()
// Called when you hit the save button
// Should probably use toServer to send changed information
//		$("#testing").html( "Data: "+ JSON.stringify(this.getData()) );
	},
	getData: function(){
		return $(this.editor)[this.editorID]("getData");
	},
	removeFromList: function(){
		var parentRefresh = this.options.parent.refresh;
		$(this.element).remove();
		parentRefresh();
// TODO: needs to also delete this connection in the configuration file.

	},
	options: {
		parent: null,
		deletable: true,
		editable: true,
		nameplaceholder: "New Client",
		supportedTypes: [
			"pptp",
			"l2tp",
			"openpvn"
		]
	}
});

// END VPN Client Widget

$.widget("jai.vpnclienteditor", $.Widget,{
	_create: function(){
		this.element.addClass("jai-vpnclient-editor");
		this.pieces = {};
		this.data = this.options.vpnclient;
		this.displaytable = $(document.createElement("table"))
			.addClass("jai-vpnclienteditor-pptp-table") // ? May be unnecessary
			.appendTo(this.element);

		this._super();
	},
	getData: function(){
		return this.data;
	},
	update: function(){
		$.map(this.pieces, function(v,i,info){
			info[i] = $(v).val();
		}, this.data);
//		$("#testing").append( "a: "+ JSON.stringify( this.data, null, 2 ) +"\n" )
	}

});

$.widget("jai.vpnclienteditor_pptp", $.jai.vpnclienteditor, {
	_create: function(){
		this._super(); // We call the parent constructor first so we can get things like displaytable and data prepared.
		$.map(
			[
				{
					value: this.options.vpnclient.name,
					displayname: "Name",
					name: "name",
					placeholder: "New PPTP Client"
				},
				{
					value: this.options.vpnclient.server,
					displayname: "Server",
					name: "server",
					placeholder: "Server Address"
				},
				{
					value: this.options.vpnclient.username,
					displayname: "Username",
					name: "username",
					placeholder: "PPTP Username"
				},
				{
					value: this.options.vpnclient.password,
					displayname: "Password",
					name: "password",
					placeholder: "PPTP Password"
				}
			],
			function(v,i, parentWidget){
				parentWidget.displaytable.append(
					$(document.createElement("tr")).append(
						$(document.createElement("td")).html(v.displayname)
					,	$(document.createElement("td")).append(
							parentWidget.pieces[v.name] = $(document.createElement("input"))
								.attr("type", "text")	// Extend to use v.type
								.attr("placeholder", v.placeholder)
								.addClass("jai-vpnclienteditor-pptp")
								.data("parentWidget", parentWidget)
								.val( v.value )
								.change(function(){ $(this).data("parentWidget").update(); })
						)
					)
				);
			},
			this	// Pass this into map because inside map "this" refers to the window
		);
	}
});

// The L2TP widget can pretty much be a duplicate of the PPTP widget, except that in future it will need to support
//	client/server certificates and some advanced features which will require more sophisticated handling
// $.widget("jai.vpnclienteditor-l2tp", "jai.vpnclienteditor" ,{
// 	_create: function(){
// 	}
// });

// The OpenVPN widget will need to be somewhat more complicated. See the current router interface for guidance.
// $.widget("jai.vpnclienteditor-openvpn", "jai.vpnclienteditor",{
// 	_create: function(){
// 	}
// });

// IPsec? SSTP?

$(function(){
	$("#vpn_clients").widgetlist({ list: vpnclients, widgetType: "vpnclient" });
});

</script>

