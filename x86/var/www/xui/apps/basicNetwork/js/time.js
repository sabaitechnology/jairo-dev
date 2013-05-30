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

/*
$.widget( "ui.hidespinner", $.ui.spinner, {
 _parse: function(value){
//  if(typeof value ==="string"){}
  return value;
 },
 _format: function(value){
  return value;
//  return Globalize.format(new Date(value),'t');
 }
});
*/
