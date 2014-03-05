

$.peekaboo = $.fn.peekaboo = function(test){
	if(test){
		$("#testing").append("Is ("+ this.attr("type") +"/"+ (this.attr("type") == "password") +") a password: ");

		if((this.attr("type") == "password"))
			$("#testing").append("Yes.\n")
		else
			$("#testing").append("No.\n")
	}
	$( this.selector || "input[type=password]" )
		.prop("type", "password")
		.focus(function(){ $(this).prop("type", "text"); })
		.blur(function(){ $(this).prop("type", "password"); })
		.keydown(function(event){ if(event.keyCode == 13){ $(this).prop("type", "password"); } });
}

function showSubMenu(){ $( "#sub"+ $(this).attr("id") ).slideToggle(500); }

$(function(){
 if(panel==""){ panel = "network"; section = "wan"; };
 $("#mainTitle").append(" - "+$(".pageTitle").html());
 $(".subMenu").hide();
 $(".superMenuLink").click(showSubMenu);
 $("#submenu_"+ panel).show();
 $("#menu_"+ panel +((section)?("_"+ section):"") ).addClass("buttonSelected");
 $.peekaboo();
});
