$.widget("jai.ipspinner", $.ui.spinner, {
 _parse: function(value){ return ( (typeof value === "string") ? ip2long(value) : value ); },
 _format: function(value){ return long2ip(value); }
});

$.widget("jai.maskspinner", $.ui.spinner, {
 options: { min: 8, max: 30 },
 _parse: function(value){ return ( (typeof value === "string") ? mask2cidr(value) : value ); },
 _format: function(value){ return cidr2mask(value); }
});

$.widget("jai.macspinner", $.ui.spinner, {
 _parse: function(value){ return ( (typeof value === "string") ? mac2long(value) : value ); },
 _format: function(value){ return long2mac(value); }
});

$.widget('jai.radioswitch', $.Widget, {
 _create: function(){
//  var opts = this.options; //.change;
  var eid = $(this.element).attr('id');
  $(this.element).change( this.options.change )
  $('<ul>').attr('id', eid +'radioSwitch').addClass('radioSwitch').append(this.element.children().map(function(i,e){
   return $('<li>')
    .html( $(e).text().trim() )
    .addClass('button')
    .attr('id', eid +'_'+ e.value )
    .data({ 'switchId': eid, 'switchValue': e.value })
    .click(function(event){ $(this).addClass('buttonSelected').siblings().removeClass('buttonSelected'); $('#'+$(this).data('switchId') ).val( $(this).data('switchValue') ).triggerHandler('change',[{ value: $(this).data('switchValue') }]); })
    .get();
  })).insertAfter(this.element);
  $('#'+eid +'_'+ this.options.value).triggerHandler('click');
  $(this.element).hide();
 }
});

$.widget( "ui.timespinner", $.ui.spinner, {
 options: {
  step: 60000, // 60 * 1000, // seconds
  page: 60 // hours
 },
 _parse: function(value){
  if( typeof value !== "string" ) return value;
  if( Number( value ) == value ) return Number( value );
  return +Globalize.parseDate( value );
 },
 _format: function(value){ return Globalize.format(new Date(value),'t'); }
});

$.widget( "jai.hidespinner", $.ui.spinner, {
 _parse: function(value){
//  if(typeof value ==="string"){}
  return value;
 },
 _format: function(value){
  return value;
//  return Globalize.format(new Date(value),'t');
 }
});


/* BEGIN Editable List Widget Junk*/

function addLI(UL){
 var LI = document.createElement('li');
 $('#'+UL).append(LI).sortable('refresh').sortable().trigger('create');
 makeEditable(LI);
 $(LI).trigger('dblclick');
}

function makeEditable(item){
 $(item).editable(function(value, settings){ if(value==''){ $(this).remove(); }; return value; },
  { 'onblur': 'submit', 'event': 'dblclick' }
 ).click(function(event,ui){ if(event.ctrlKey) $(this).remove(); });
}

function makeEditableList(listArray, listElement, formElement){
 $(listElement).html( $.map(listArray,function(v,i){ return "<li id='"+ v +"'>"+v+"</li>"; }).join('') ).sortable({
  forcePlaceholderSize: true,
  forceHelperSize: true,
  placeholder: "editableListPlaceholder",
  create: function(event,ui){
   makeEditable($(this).children('li'));
   $(formElement).val($(listElement).sortable('toArray'));
  },
  stop: function(event,ui){
   $(formElement).val($(listElement).sortable('toArray'));
  }
 });
}

/* END Editable List Widget Junk*/
