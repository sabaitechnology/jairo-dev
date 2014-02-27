<div class="pageTitle">VPN: Clients</div>
<br>
<div id="vpnclients"></div>

<pre id="reply"></pre>
<pre id="testing"></pre>

<!-- <script type="text/ecmascript" php="src/etc.php?q=vpnclients"></script> -->
<script type="text/ecmascript">
// BEGIN Widget List
// To create a jQuery Widget we invoke the widget constructor $.widget; it takes three arguments:
	//	- the widget we're creating ("jai.widgetlist" in this case)
	//	- the base widget it inherits from (can be "jQuery.Widget", the generic widget)
	//	- the prototype, which is the object those properties override the base
$.widget("jai.widgetlist", $.ui.sortable, {
	// makeList: function(){},
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
		// this.makeList();
		if(!this.options.list){
			if(!this.options.file){
				$(this.element).after("\n!!! The configuration section was not specified.\n");
			}else{

				// $(this.element).after("\n!!! Get config with ajax.\n");
				// $.ajax()
			}
		}else{
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
	 				).after(
	 					$(document.createElement("input"))
	 						.prop("type","button")
	 						.val("Save Test")
	 						.click(function(){
	 							$("#kitty").vpnclient("saveData");
	 						})
	 					,$(document.createElement("input"))
	 						.prop("type","button")
	 						.val("Send Test")
	 						.click(testSend)
	 				);
				}
		//	this widget inherits from ui.sortable, so we need to call its constructor to finish up
				this._super();
			}
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
		item.name = index;
		// Just create a straightforward list if no widget type is supplied.
		//  this will need fixed to create the normal editable list, perhaps with a default list item constructor
		if(!parentWidget.options.widgetType){
			$(document.createElement("li"))
				.appendTo(parentWidget.element)
				.append(JSON.stringify(item))
		}else{
	//	We're passing the fixed option and parent element to the widget constructor
	//	 so that it can add appropriate delete buttons and call the parent's refresh function
			$(document.createElement("li"))
				.appendTo(parentWidget.element)
	//	the object element named in brackets here is the constructor for the widgets that make up the list
				[parentWidget.options.widgetType](
	//	We merge the item object passed into makeItem with properties that allow us to interface with the parent widgetlist.
					{
	//	here we pass a refresh function for the parent widget as an anonymous function
	//	this decouples the parent and child widgets
						parent: {
							widget: parentWidget,
							refresh: function(){ $(parentWidget.element).widgetlist("refresh"); },
							saveData: function(){ $(parentWidget.element).widgetlist("saveData"); },
							fixed: parentWidget.options.fixed,
							type: "widgetlist",
							element: $(parentWidget.element).attr("id"),
							conf: parentWidget.options.conf
						},
						details: item,
						index: index
					}
				);
		}
	},
	//	the default function for adding an item
 	addItem: function(){
		this.makeItem(null,-1,this);
		this.refresh();
 	},
 	saveData: function(){
 		// var data = {};
 		// $.map( $("."+ $(this.element).attr("id") +"-list-child" ).get(), function(v,i,me){
 		// 	$.merge(data,$(v)[me.options.widgetType]("getData"))
 		// 	// var idata = $(v)[me.options.widgetType]("getData");
 		// 	// data[idata.name] = idata;
 		// }, this);
 		// $("#testing").html(
 		// );
//		ro.send(data, "save");
 	},
 	options: {
 		fixed: false,
 	}
});
// END Widget List

// BEGIN VPN Client Widget

$.widget("jai.vpnclient", $.Widget,{
	_create: function(){
		if(this.options.parent){
			this.options.deletable = this.options.deletable && (!this.options.parent.fixed);	
			this.element.addClass( this.options.parent.element +"-list-child");
			this.conf = this.options.parent.conf +"."+ this.options.index;
		}else{
			if(this.options.conf) this.conf = this.options.conf;
		}
		if(this.options.index) this.index = this.options.index;
		this.element.addClass("jai-vpnclient")
		this.makeRow();
		if(!this.options.details){
			this.title.html(this.options.nameplaceholder);
			this.options.editing = true;
		}else{
			this.data = this.options.details;
			this.updateName();
		}
		if(this.options.editing) this.edit();
	},
	makeRow: function(){
		$(document.createElement("div"))
			.addClass("jai-vpnclient-container")
			.append(
				this.title = $(document.createElement("span"))
					.addClass("jai-vpnclient-name")
				,this.state = $(document.createElement("span"))
					.addClass("jai-vpnclient-state")
					.html("State")
				,this.controls = $(document.createElement("span"))
					.addClass("fright")
			)
			.appendTo(
				this.element
					.addClass("jai-vpnclient")
			);
		this.buttons = {};
		this.buttons.act = $(document.createElement("input"))
			.appendTo(this.controls)
			.addClass("inlineButton actButton")
			.prop("type","button")
			.val("Act")
			.data("parentWidget", this)
			.click(function(){ $(this).data("parentWidget").act(); })
		if( this.options.editable ){
			this.buttons.edit = $(document.createElement("input"))
				.appendTo(this.controls)
				.addClass("inlineButton editButton")
				.prop("type","button")
				.val("Edit")
				.data("parentWidget", this)
				.click(function(){ $(this).data("parentWidget").edit(); })
			this.buttons.save = $(document.createElement("input"))
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
		this.options.idString = this.data.name.replace(" ","_");
		this.element.attr("id",this.options.idString);
		this.title.html(this.data.name);
		this.state.attr("id",this.options.idString+"_info")
		$.map(this.buttons, function(v,i, widgetID){
			$(v).data("widgetID", widgetID);
		}, this.options.idString);
	},
	selectType: function(){
		if(!this.data) this.data = {};
		this.data.type = $("#vpnclienteditor-typeselector").val();
		$("#vpnclienteditor-typeselector-section").remove();
		this.edit();
	},
	edit: function(){
		this.buttons.act.hide();
		this.buttons.edit.hide();
// make sure we have a type
		if(!this.data || !this.data.type){
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
				this.editorID = "vpnclienteditor_"+ this.data.type;
				if($.jai[this.editorID]){
					this.editor = $(document.createElement("div"))
						.appendTo( this.element )
						[this.editorID]({ details: this.data, parentWidget: this });
				}else{
					$(this.element).after("\n!!! There is currently no editor for this type. Please fix this.\nRaw data: "+ JSON.stringify(this.options.vpnclient) +"\n")
				}
			}
			this.editor.slideDown();
		}
	},
	save: function(){
		this.buttons.act.show();
		this.buttons.edit.show();
		this.buttons.save.hide();
		if(this.editor) $(this.editor).slideUp();
		this.saveData();
	},
	saveData: function(){
		// if(this.options.parent){
		// 	this.options.parent.saveData(); // call the parent save function	
		// }else{
		// 	// TODO: save individual configuration section
		// }
		$("#testing").append(JSON.stringify(this.getData(), null, " "));
		ro.send(this.getData(), "conf");

	},
	getData: function(){
		return { key: this.key, data: this.data };
	},
	setData: function(i,v){
		this.data[i] = v;
		if(i == "name") this.updateName();
		if(this.options.parent) this.options.parent.setData(this.data.name,this.data); // call the parent set function
	},
	removeFromList: function(){
		var parentRefresh = this.options.parent.refresh;
		var parent = this.options.parent.widget;
		$(this.element).remove();
		parentRefresh();
		parent.saveData();
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
		this.parentWidget = this.options.parentWidget;
		this.displaytable = $(document.createElement("table"))
			.addClass("jai-vpnclienteditor-pptp-table") // ? May be unnecessary
			.appendTo(this.element);

		this._super();
	}
});

$.widget("jai.vpnclienteditor_pptp", $.jai.vpnclienteditor, {
	// TODO: appropriately abstract _create
	_create: function(){
		this._super(); // We call the parent constructor first so we can get things like displaytable and data prepared.
		$.map(
			[
				{
					value: this.parentWidget.data.name,
					displayname: "Name",
					name: "name",
					placeholder: "New PPTP Client"
				},
				{
					value: this.parentWidget.data.server,
					displayname: "Server",
					name: "server",
					placeholder: "Server Address"
				},
				{
					value: this.parentWidget.data.username,
					displayname: "Username",
					name: "username",
					placeholder: "PPTP Username"
				},
				{
					value: this.parentWidget.data.password,
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
							$(document.createElement("input"))
								.attr("type", "text")	// TODO: Extend to use v.type
								.attr("placeholder", v.placeholder)
								.addClass("jai-vpnclienteditor-pptp")
								.data("parentWidget", parentWidget.parentWidget)
								.data("name", v.name)
								.val( v.value )
								.change(function(){
									$(this).data("parentWidget").setData( $(this).data("name"), $(this).val() );
								})
						)
					)
				);
			},
			this	// Pass this into map because inside map "this" refers to the window
		);
	}
});

var vcl = {
	"kitty": {
		"type": "pptp",
		"server": "203.54.1.20",
		"username": "chinacat",
		"password": "meowmeow",
		"name": "kitty"
	},
	"Tokyo": {
		"type": "l2tp",
		"server": "200.50.2.7",
		"username": "someguy",
		"password": "password",
		"psk": "presharedkey",
		"name": "Tokyo"
	},
	"New York": {
		"type": "openvpn",
		"server": "42.2.2.2",
		"username": "topofspaghetti",
		"password": "meatball",
		"name": "New York"
	}
};

function testSend(){
	$("#reply").html("Reply:\n");
	ro.send({ file: "vpnclients" }, "conf", function(data){
		$("#reply").append(JSON.stringify(data, null, " "));
	});	
}

$(function(){
	$("#vpnclients").widgetlist({ list: vcl, file: "vpnclients", widgetType: "vpnclient" });
	$("#kitty").vpnclient("edit");
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

</script>

