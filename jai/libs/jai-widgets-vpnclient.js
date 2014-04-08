
// BEGIN Widget List
// To create a jQuery Widget we invoke the widget constructor $.widget; it takes three arguments:
//		- the widget we're creating ("jai.widgetlist" in this case)
//		- the base widget it inherits from (can be "jQuery.Widget", the generic widget)
//		- the prototype, which is the object those properties override the base
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
	_init: function(){
		if(!this.created) return;
		// First we need to make sure we have our configuration information
		// It should either be passed in directly, as "list" in our options,
		// or indicated as "file" so we can get that.
		if(!this.options.list){
			if(!this.options.file){
				// If no configuration information is specified, this is a problem.
				// We need some error facility with our widgets; something as simple as red text, even.
				this.show("!!! The configuration section was not specified.");
			}else{
				// Retrieve our configuration information
				// We need to alias "this" for our callback
				var me = this;
				ro.send({ file: this.options.file }, "conf", function(data){
					// At this point, it's as simple as setting the list info and running our usual creation routine.
					me.options.list = data;
					me._init();
				});
			}
		}else{
			// $("#testing").html( JSON.stringify(this.options.list, null, "  ") );
			this.items = $.map(this.options.list, this.makeItem, this);
		}
	},
	_create: function(){
		if(!$(this.element).is("ul")){
			//	the base element for our list is a ul, so if we are passed another type of element we
			//		- create a ul in it
			//		- reassign the element's id and rename the element with a new id
			//		- call our widget's constructor on that
			//		- clean up any unfortunate pre-_create effects on this.element
			var baseElementID = $(this.element).attr("id");
			var baseElement = document.createElement("ul");
			$(this.element).append(baseElement).attr("id", baseElementID +"-base");
			$(baseElement).attr("id", baseElementID).widgetlist(this.options);
			// Everything else in this if is to deconstruct the bits of widget attached to the incorrect element.
			// In particular we replace this.options with an empty object to prevent events from firing (like create).
			this.element
				.unbind( this.eventNamespace )
				.removeData( this.widgetFullName )
			this.bindings.unbind( this.eventNamespace );
			this.options = {};
		}else{
			//	apply the widgetlist style
			this.element.addClass("jai-widgetlist");
			//	the default method for making a list item can be overridden if necessary
			if(this.options.makeItem) this.makeItem = this.options.makeItem;
			//	now we add an item for each element of the list
			if(!this.options.fixed){
				// Pass the id explicitly into any listeners to ensure they have the correct id;
				// "this" refers to the window when these functions are called in the UI.
				var myElementID = this.element.attr("id");
				$(this.element).after(
						$(document.createElement("input"))
							.prop("type","button")
							.val("Add")
							.data("widgetListID",this.element.attr("id"))
							.click(function(){
								$("#"+ myElementID).widgetlist("addItem");
							})
						,$(document.createElement("input"))
							.prop("type","button")
							.val("Save")
							.data("widgetListID",this.element.attr("id"))
							.click(function(){
								$("#"+ myElementID).widgetlist("saveData");
							})
					);
			}
			//	this widget inherits from ui.sortable, so we need to call its constructor to finish up
			this._super();
			this.created = true;
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
			return $(document.createElement("li"))
				.appendTo(parentWidget.element)
				.append(JSON.stringify(item))
		}else{
	//	We're passing the fixed option and parent element to the widget constructor
	//	 so that it can add appropriate delete buttons and call the parent's refresh function
			return $(document.createElement("li"))
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
							file: parentWidget.options.file
						},
						details: item,
						key: index
					}
				)
		}
	},
	//	the default function for adding an item
	addItem: function(){
		this.makeItem(null,-1,this);
		this.refresh();
	},
	saveData: function(){
		//ro.save(conf
		$("#testing").append("Listdata:\n"+ JSON.stringify(
			{
				data: $.map(this.items, function(v,i,widgetType){
					return v[widgetType]("getData").data;
				}, this.options.widgetType),
				set: true,
				file: this.options.file
			}
		, null, "  ")
		);
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
			this.file = this.options.parent.file;
			this.key = this.options.key;
		}else{
			if(this.options.key) this.key = this.options.key;
		}
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
				,this.message = $(document.createElement("div"))
					.addClass("vpnclient-message")
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
			//	if we have not yet constructed the editor, do it now
			if( !this.editor ){
				this.editorType = "vpnclienteditor_"+ this.data.type;
				if($.jai[this.editorType]){
					this.editor = $(document.createElement("div"))
						.appendTo( this.element )
						[this.editorType]({ details: this.data, parentWidget: this });
				}else{
					this.show("!!! There is currently no editor for this type. Please fix this.");
					return;
					// $(this.element).after("\n!!! There is currently no editor for this type. Please fix this.\nRaw data: "+ JSON.stringify(this.options.vpnclient) +"\n")
				}
			}
			this.buttons.save.show();
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
		
		// var conf = this.getData();
		// $("#testing").append("Listdata:\n"+ JSON.stringify(conf, null, "  ") +"\n");
		
			ro.save(this.getData());
		// }
	},
	getData: function(){
		return { file: this.file, key: this.key, data: this.data };
	},
	setData: function(i,v){
		this.data[i] = v;
		if(i == "name") this.updateName();
		// if(this.options.parent) this.options.parent.setData(this.data.name,this.data); // call the parent set function
	},
	removeFromList: function(){
		var parentRefresh = this.options.parent.refresh;
		var parent = this.options.parent.widget;
		$(this.element).remove();
		parentRefresh();
		parent.saveData();
// TODO: needs to also delete this connection in the configuration file.
	},
	show: function(msg){
		$(this.message).html(msg);
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
	},
	makeEditor: function(){
		$.map(this.fields,
			function(v,i, parentWidget){
				parentWidget.displaytable.append(
					$(document.createElement("tr")).append(
						$(document.createElement("td")).html(v.displayname)
					,	$(document.createElement("td")).append(
							field = $(document.createElement("input"))
								.attr("type", v.type || "text")	// TODO: Extend to use v.type
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
				// if(v.type == "password") $(field).peekaboo();
			},
			this	// Pass this into map because inside map "this" refers to the window
		);
	},

	buildFileEditor: function(){
		$("#openvpnfile").html("");

		//for each key
		for(i=0; i<keys.length; i++){
			var temp=keys[i];
			//TODO:tempmatch should use regex to find each key in conf file (see confkeys.js)
			var tempmatch=[]
			
			$(document.createElement("tr"))
				.prop("id", i)
				.append($(document.createElement("td")).html(temp + " \/ ")
					.prepend($(document.createElement("input"))
						.prop("id", i)
						.attr('type', 'checkbox')
					)
					.append($(document.createElement("input"))
							.attr("type","text")
							.val(tempmatch)
					)
				)
				.append($(document.createElement("td"))
					.prepend($(document.createElement("input"))
						.prop("id", i)
						.prop("class", "deletebutton")
						.attr('type', 'button')
						.val("Delete")
					)
				)

			.appendTo("#openvpnfile")
		}
	}
});

$.widget("jai.vpnclienteditor_pptp", $.jai.vpnclienteditor, {
	// TODO: appropriately abstract _create
	_create: function(){
		this._super(); // We call the parent constructor first so we can get things like displaytable and data prepared.
		this.fields = [
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
			{ // TODO: needs to be "password" type
				value: this.parentWidget.data.password,
				displayname: "Password",
				name: "password",
				type: "password",
				placeholder: "PPTP Password"
			}
		];
		this.makeEditor();
	}
});

// The L2TP widget can pretty much be a duplicate of the PPTP widget with a PSK field, except that in future it will need to support
//	client/server certificates and some advanced features which will require more sophisticated handling

$.widget("jai.vpnclienteditor_l2tp", $.jai.vpnclienteditor, {
	_create: function(){
		this._super(); 
		this.fields = [
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
			{ // TODO: needs to be "password" type
				value: this.parentWidget.data.password,
				displayname: "Password",
				name: "password",
				type: "password",
				placeholder: "PPTP Password"
			},
			{ // TODO: needs to be "password" type
				value: this.parentWidget.data.psk,
				displayname: "PSK",
				name: "PSK",
				type: "password",
				placeholder: "PPTP Preshared Key"
			}
		];
		this.makeEditor();
	}
});





// The OpenVPN widget will need to be somewhat more complicated. See the current router interface for guidance.


$.widget("jai.vpnclienteditor_openvpn", $.jai.vpnclienteditor, {
	// TODO: appropriately abstract _create
	_create: function(){
		this._super(); // We call the parent constructor first so we can get things like displaytable and data prepared.
		this.fields = [
			{
				value: this.parentWidget.data.name,
				displayname: "Name",
				name: "name",
				placeholder: "New PPTP Client"
			},
			{
				value: this.parentWidget.data.username,
				displayname: "Username",
				name: "username",
				placeholder: "PPTP Username"
			},
			{ // TODO: needs to be "password" type
				value: this.parentWidget.data.password,
				displayname: "Password",
				name: "password",
				type: "password",
				placeholder: "PPTP Password"
			}
		];
		this.makeEditor();

		$(document.createElement("div"))
			.attr("id", "openvpncontrol")
			.append( $(document.createElement('p')).html('file opener widget') )
	        	
	   //TODO: this should appear after a file is selected
		.append($(document.createElement("input"))
			.attr("id", "editovpnfile")
			.prop("type","button")
			.val("Edit File")
			.click( function(){
				$("#openvpnfile").show()
				$(this).hide()
				$("#closeedit").show()
			})
		)
		.append($(document.createElement("input"))
			.attr("id", "closeedit")
			.prop("type","button")
			.val("Close Editor")
			.css("display", "none")
			.click( function(){
				$("#openvpnfile").hide()
				$(this).hide()
				$("#editovpnfile").show()
			})
		)
		.append($(document.createElement("div"))
			.attr("id", "openvpnfile")
			.html("File here!")
			.css("display", "none")
			.css("background", "#DBDBDB")
		)
		.appendTo(".jai-vpnclient-editor")

		this.buildFileEditor();

	}
});


// TODO: IPsec? SSTP?
//TODO: add log to log page

var keys = ["help",
"config file",
"mode m",
"local host",
"remote host [port] [proto]",
"remote-random-hostname",
"proto-force p",
"remote-random",
"proto p",
"connect-retry n",
"connect-timeout n",
"connect-retry-max n",
"show-proxy-settings",
"http-proxy server port [authfile|'auto'|'auto-nct'] [auth-method]",
"http-proxy-retry",
"http-proxy-timeout n",
"http-proxy-option type [parm]",
"socks-proxy server [port]",
"socks-proxy-retry",
"resolv-retry n",
"float",
"ipchange cmd",
"port port",
"lport port",
"rport port",
"bind",
"nobind",
"dev tunX | tapX | null",
"dev-type device-type",
"topology mode",
"tun-ipv6",
"dev-node node",
"lladdr address",
"iproute cmd",
"ifconfig l rn",
"ifconfig-noexec",
"ifconfig-nowarn",
"route network/IP [netmask] [gateway] [metric]",
"max-routes n",
"route-gateway gw|'dhcp'",
"route-metric m",
"route-delay [n] [w]",
"route-up cmd",
"route-pre-down cmd",
"route-noexec",
"route-nopull",
"allow-pull-fqdn",
"client-nat snat|dnat network netmask alias",
"redirect-gateway flags...",
"link-mtu n",
"redirect-private [flags]",
"tun-mtu n",
"tun-mtu-extra n",
"mtu-disc type",
"mtu-test",
"fragment max",
"mssfix max",
"sndbuf size",
"rcvbuf size",
"mark value",
"socket-flags flags...",
"txqueuelen n",
"shaper n",
"inactive n [bytes]",
"ping n",
"ping-exit n",
"ping-restart n",
"keepalive n m",
"ping-timer-rem",
"persist-tun",
"persist-key",
"persist-local-ip",
"persist-remote-ip",
"mlock",
"up cmd",
"up-delay",
"down cmd",
"down-pre",
"up-restart",
"setenv name value",
"setenv FORWARD_COMPATIBLE 1",
"setenv-safe name value",
"script-security level",
"disable-occ",
"user user",
"group group",
"cd dir",
"chroot dir",
"setcon context",
"daemon [progname]",
"syslog [progname]",
"errors-to-stderr",
"passtos",
"inetd [wait|nowait] [progname]",
"log file",
"log-append file",
"suppress-timestamps",
"writepid file",
"nice n",
"fast-io",
"multihome",
"echo [parms...]",
"remap-usr1 signal",
"verb n",
"status file [n]",
"status-version [n]",
"mute n",
"comp-lzo [mode]",
"comp-noadapt",
"management IP port [pw-file]",
"management-client",
"management-query-passwords",
"management-query-proxy",
"management-query-remote",
"management-forget-disconnect",
"management-hold",
"management-signal",
"management-log-cache n",
"management-up-down",
"management-client-auth",
"management-client-pf",
"management-client-user u",
"management-client-group g",
"plugin module-pathname [init-string]",
"server network netmask",
"server-bridge gateway netmask pool-start-IP pool-end-IP",
"server-bridge ['nogw']",
"push option",
"push-reset",
"push-peer-info",
"disable",
"ifconfig-pool start-IP end-IP [netmask]",
"ifconfig-pool-persist file [seconds]",
"ifconfig-pool-linear",
"ifconfig-push local remote-netmask [alias]",
"iroute network [netmask]",
"client-to-client",
"duplicate-cn",
"client-connect cmd",
"client-disconnect cmd",
"client-config-dir dir",
"ccd-exclusive",
"tmp-dir dir",
"hash-size r v",
"bcast-buffers n",
"tcp-queue-limit n",
"tcp-nodelay",
"max-clients n",
"max-routes-per-client n",
"stale-routes-check n [t]",
"connect-freq n sec",
"learn-address cmd",
"auth-user-pass-verify cmd method",
"opt-verify",
"auth-user-pass-optional",
"client-cert-not-required",
"username-as-common-name",
"compat-names [no-remapping] (DEPRECATED)",
"no-name-remapping (DEPRECATED)",
"port-share host port [dir]",
"client",
"pull",
"auth-user-pass [up]",
"auth-retry type",
"static-challenge t e",
"server-poll-timeout n",
"explicit-exit-notify [n]",
"secret file [direction]",
"key-direction",
"auth alg",
"cipher alg",
"keysize n",
"prng alg [nsl]",
"engine [engine-name]",
"no-replay",
"replay-window n [t]",
"mute-replay-warnings",
"replay-persist file",
"no-iv",
"use-prediction-resistance",
"test-crypto",
"tls-server",
"tls-client",
"ca file",
"capath dir",
"dh file",
"cert file",
"extra-certs file",
"key file",
"pkcs12 file",
"verify-hash hash",
"pkcs11-cert-private [0|1]...",
"pkcs11-id name",
"pkcs11-id-management",
"pkcs11-pin-cache seconds",
"pkcs11-protected-authentication [0|1]...",
"pkcs11-providers provider...",
"pkcs11-private-mode mode...",
"cryptoapicert select-string",
"key-method m",
"tls-cipher l",
"tls-timeout n",
"reneg-bytes n",
"reneg-pkts n",
"reneg-sec n",
"hand-window n",
"tran-window n",
"single-session",
"tls-exit",
"tls-auth file [direction]",
"askpass [file]",
"auth-nocache",
"tls-verify cmd",
"tls-export-cert directory",
"x509-username-field fieldname",
"tls-remote name (DEPRECATED)",
"verify-x509-name name type",
"x509-track attribute",
"ns-cert-type client|server",
"remote-cert-ku v...",
"remote-cert-eku oid",
"remote-cert-tls client|server",
"crl-verify crl ['dir']",
"show-ciphers",
"show-digests",
"show-tls",
"show-engines",
"genkey",
"secret file",
"mktun",
"rmtun",
"dev tunX | tapX",
"user user",
"group group",
"win-sys path",
"ip-win32 method",
"route-method m",
"dhcp-option type [parm]",
"tap-sleep n",
"show-net-up",
"dhcp-renew",
"dhcp-release",
"register-dns",
"pause-exit",
"service exit-event [0|1]",
"show-adapters",
"allow-nonadmin [TAP-adapter]",
"show-valid-subnets",
"show-net"]
