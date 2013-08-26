
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

function A(type){ return document.createElement(type); }
function T(text){ return document.createTextNode(text); }
function F(){ return document.createDocumentFragment(); }

function showSubMenu(){ $('#'+ $(this).attr('id') +'SubMenu').slideToggle(500); }
function shortSwitchSelect(){
 $(this).siblings().removeClass('buttonSelected');
 $(this).addClass('buttonSelected');
 $('#'+$(this).parent().attr('for') ).val( $(this).attr('value') );
}

$(function(){ if(panel==''){ panel = 'network'; }; if(section==''){ section = 'wan'; }
 $('#mainTitle').append(' - '+$('.pageTitle').html());
 $('.subMenu').hide(); $('.superMenuLink').click(showSubMenu); $('#'+ panel +'SubMenu' ).show();
 $('#'+ panel +'_'+ section ).addClass('buttonSelected');
});

function sub(){
 $('#demo').html( ($('#fe').serialize()).replace(/&/g,'&\n') );
}

