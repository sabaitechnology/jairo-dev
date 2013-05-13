$.widget("jai.ipspinner", $.ui.spinner, {
 _parse: function(value){ return ( (typeof value === "string") ? ip2long(value) : value ); },
 _format: function(value){ return long2ip(value); }
});

$.widget("jai.maskspinner", $.ui.spinner, {
 options: { min: 8, max: 30 },
 _parse: function(value){ return ( (typeof value === "string") ? mask2cidr(value) : value ); },
 _format: function(value){ return cidr2mask(value); }
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
