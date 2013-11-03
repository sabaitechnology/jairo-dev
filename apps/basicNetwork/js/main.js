
function what(obj,ownonly,pre){
// if($.isPlainObject(obj)) return 'EMPTY';
 var txt=[];
 if(pre) txt.push('<pre>');
 txt.push(obj);
 for(var i in obj){
 if(ownonly && obj.hasOwnProperty(i)) txt.push(i +': '+ obj[i]); }; 
 if(pre) txt.push('</pre>');
 return txt.join('\n');
}

function showSubMenu(){ $('#'+ $(this).attr('id') +'SubMenu').slideToggle(500); }
function shortSwitchSelect(){
 $(this).siblings().removeClass('buttonSelected');
 $(this).addClass('buttonSelected');
 $('#'+$(this).parent().attr('for') ).val( $(this).attr('value') );
}

function sub(){
 $('#demo').html( ($('#fe').serialize()).replace(/&/g,'&\n') );
}

$(function(){
 if(panel==''){ panel = 'network'; section = 'wan'; };
 $('#mainTitle').append(' - '+$('.pageTitle').html());
 $('.subMenu').hide(); $('.superMenuLink').click(showSubMenu); $('#'+ panel +'SubMenu' ).show();
 $('#'+ panel +((section)?('_'+ section):'') ).addClass('buttonSelected');
});