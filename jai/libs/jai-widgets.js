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
  
    var eid = $(this.element).attr('id');
    
    //hide or show children when the switch changes
    if(this.options.hasChildren) 
      $(this.element).change(function(event,ui){
        $('.' + eid).hide(); 
        $('.'+ eid +'-'+ ui.value ).show();
      });

    $('<ul>').attr('id', eid +'radioSwitch')
      .addClass('radioSwitch')
      .append(this.element.children()
        .map(function(i,e){
          return $('<li>')
          .html( $(e).text().trim() )
          .addClass('button')
          .attr('id', eid +'_'+ e.value )
          .data({ 'switchId': eid, 'switchValue': e.value })
          .click(function(event){
            $(this).addClass('buttonSelected').siblings().removeClass('buttonSelected');
            $('#'+$(this).data('switchId'))
              .val( $(this).data('switchValue'))
              .triggerHandler('change',[{ value: $(this).data('switchValue') }]);
          })
          .get();
        })
      ).insertAfter(this.element);
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

$.widget( "jai.oldeditablelist", $.ui.sortable, {
 _create: function(){
  this.element.addClass('editableList');
  this.options.fid = this.element.attr('id');
  this.addItems(this.options.list);
  if(!this.options.fixed) $(this.element).after("<br><input type='button' value='Add' onclick='$(\"#"+ this.options.fid +"\").editablelist(\"addItems\")'>");
  this._super();
 },
 addItems: function(a){ if(a==null) a = false;
  var fid = this.options.fid;
  var fixed = this.options.fixed;
  $(this.element).addClass("editableList");
  $(this.element).append( $.map( ( a||[''] ),function(v,i){
    return $(document.createElement('li'))
    .append( $(document.createElement('input')).addClass("editableFormComplement").prop("type","hidden").prop("name",fid+"[]").val(v) )
    .append( $(document.createElement('span')).addClass("editableListText").html(v) )
    .append( (fixed ? null : $(document.createElement('a')).addClass("deleteX").html("X")) );
  }));
  if(!fixed) $(this.element).find('.deleteX').click(function(event){ $(event.target).parent().remove(); });
  $(this.element).find('.editableListText').editable(function(value, settings){
    if(!fixed) if(value==''){ $(this).parent().remove(); };
    $(this).siblings('.editableFormComplement').val(value);
    return value;
   },{ 'onblur': 'submit', 'event': 'dblclick', placeholder: '(Double click to edit.)' }
  );
  if($(this.element).data('sortable')) $(this.element).sortable('refresh');
  if(!a) $(this.element).last().children().last().children('.editableListText').trigger('dblclick');
 },
 options: {
  forcePlaceholderSize: true,
  forceHelperSize: true,
  placeholder: "editableListPlaceholder",
  items: "li:not(.listBookend)",
 }
});


/* END Editable List Widget Junk*/

$.widget( "jai.accord", $.ui.accordion, {
 
  _create: function(){
    var addItems = this.options.static;
    if(addItems==false){
      $(this.element).after("<br><input type=button name='add_new' class='add_new' value='Add New' onClick='addNew();'/>")  
    }else{}
    this._super();
  },

  _refresh: function(){
    $(this.element).find('.delete').remove();
    $(this.element).find('h3').append("<a href='#' class='fright delete'>x</a>")
    this._super();
  },

  newItem: function(){
    $(this.element).find('.delete').last().remove();
    $(this.element).children('h3').last().append("<a href='#' class='fright delete'>x</a>")
  },

  options:{
    active:false,
    animate: false,
    collapsible:true,
    heightStyle:"content",
  }
});

//LAN PAGE WIDGETS

// (currently on lan page)

//END LAN PAGE WIDGETS
