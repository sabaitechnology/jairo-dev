
function what(obj,pre){
 if($.isPlainObject(obj)) return 'EMPTY';
 var txt=[];
 if(pre) txt.push('<pre>');
 var txt=[obj];
 for(var i in obj){ txt.push(i +': '+ obj[i]); }; 
 if(pre) txt.push('</pre>');
 return txt.join('\n');
}

function showSubMenu(){ $('#'+ $(this).attr('id') +'SubMenu').slideToggle(500); }
function shortSwitchSelect(){ $(this).siblings().removeClass('buttonSelected'); $(this).addClass('buttonSelected'); }

$(function(){ if(panel==''){ panel = 'network'; }; if(section==''){ section = 'wan'; }
 $('#mainTitle').append(' - '+$('.pageTitle').html());
 $('.subMenu').hide(); $('.superMenuLink').click(showSubMenu); $('#'+ panel +'SubMenu' ).show();
 $('#'+ panel +'_'+ section ).addClass('buttonSelected');
});

