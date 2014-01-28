
function peekaboo(){
	$('input[type=password]').each(function(i, e){
		$(e).focus(function(){ $(this).prop('type', 'text'); });
		$(e).blur(function(){ $(this).prop('type', 'password'); });
		$(e).keydown(function(event){ if(event.keyCode == 13){ $(this).prop('type', 'password'); } });
	});
}

function showSubMenu(){ $( '#sub'+ $(this).attr('id') ).slideToggle(500); }

$(function(){
 if(panel==''){ panel = 'network'; section = 'wan'; };
 $('#mainTitle').append(' - '+$('.pageTitle').html());
 $('.subMenu').hide();
 $('.superMenuLink').click(showSubMenu);
 $('#submenu_'+ panel).show();
 $('#menu_'+ panel +((section)?('_'+ section):'') ).addClass('buttonSelected');
 peekaboo();
});
