<div class="pageTitle">VPN: Clients</div>
<br>
<div id="vpnclients"></div>

<!-- <input id="filetest" type="file"></div> -->

<div id="filetest"><span></span></div>

<pre id="reply"></pre>
<pre id="testing"></pre>

<script src="/libs/jai-widgets-vpnclient.js"></script>
<script type="text/ecmascript">

$.widget("jai.textfile", $.Widget,{
	_create: function(){
		$("#testing").append("Children: "+  );

		if(!$(this.element.is("div")) || $(this.element).children().length){
			console.log("Not a div. Please supply jai.textfile with a div.");

			// // Create div sandbox inside element
			// if($(this.element).is('input[type="file"]')){
			// 	// Create div sandbox around input
			// 	$("#testing").html("Correct.");
			// }else{
			// 	// Create div inside element
			// }
			// // Deconstruct leftovers
			// this.element
			// 	.unbind( this.eventNamespace )
			// 	.removeData( this.widgetFullName )
			// this.bindings.unbind( this.eventNamespace );
			// this.options = {};
		}else{
			// Element is div, does it have a file upload element?
		}

			// // var baseElementID = $(this.element).attr("id");
			// // var baseElement = document.createElement("input").attr("type","file");
			// // $(this.element).append(baseElement).attr("id", baseElementID +"-base");
			// // $(baseElement).attr("id", baseElementID).textfile(this.options);



		// if(this.options.parent){
		// 	this.options.deletable = this.options.deletable && (!this.options.parent.fixed);	
		// 	this.element.addClass( this.options.parent.element +"-list-child");
		// 	this.file = this.options.parent.file;
		// 	this.key = this.options.key;
		// }else{
		// 	if(this.options.key) this.key = this.options.key;
		// }
		// this.element.addClass("jai-vpnclient"
		// $(document.createElement("div"))
		// 	.addClass("jai-vpnclient-container")
		// 	.append(
		// 		this.title = $(document.createElement("span"))
		// 			.addClass("jai-vpnclient-name")
		// 		,this.state = $(document.createElement("span"))
		// 			.addClass("jai-vpnclient-state")
		// 			.html("State")
		// 		,this.controls = $(document.createElement("span"))
		// 			.addClass("fright")
		// 		,this.message = $(document.createElement("div"))
		// 			.addClass("vpnclient-message")
		// 	)
		// 	.appendTo(
		// 		this.element
		// 			.addClass("jai-vpnclient")
		// 	);
		// this.buttons = {};
		// this.buttons.act = $(document.createElement("input"))
		// 	.appendTo(this.controls)
		// 	.addClass("inlineButton actButton")
		// 	.prop("type","button")
		// 	.val("Act")
		// 	.data("parentWidget", this)
		// 	.click(function(){ $(this).data("parentWidget").act(); })

	},
	// ,save: function(){}
	// ,saveData: function(){}
	// ,show: function(msg){ $(this.message).html(msg); }
	// ,options: {}
});

function getFilesOn(element, fileInputElement, eventType, singleFile, callback){
	$(element).on(eventType, function(event){ getfiles(event, fileInputElement, singleFile, callback); });
}

function getFiles(event){
	$("#info").html("");

	var files = $("#fileName")[0].files;
	var fileContents = [];
	for(var i = 0, f; f = files[i]; i++){
		var r = new FileReader();
		r.onload = (function(f){
			return function(e){
				$("#info").append(
					"Name: "+ escape(f.name) +"\n"+
					"Type: "+ escape(f.type) +"\n"+
					"Size: "+ escape(f.size) +"\n"+
					"Lmod: "+ (f.lastModifiedDate ? f.lastModifiedDate.toLocaleDateString() : 'n/a') +"\n"+
					"Content:\n"+ r.result +"\n"
				);
			};
		})(f)
		r.readAsText(f);
		$("#info").append("Reading "+ f.name +"\n");
	}
}



$(function(){

	// $("#fileName").change(getFiles);
	// $("#uploadButton").click(getFiles);

	$("#filetest").textfile();

//	$("#vpnclients").widgetlist({ file: "vpnclients", widgetType: "vpnclient" });
		// ,create: function(){ $("#testing").append("Create fires ("+ $(this).prop("tagName") +"/"+ $(this).attr("id") +").\n") }
	// });



});

// $.ajax()

</script>

