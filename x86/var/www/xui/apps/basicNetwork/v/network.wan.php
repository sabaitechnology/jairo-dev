<div class='pageTitle'>Network: Wan</div>
<div class='controlBox'>

<ul id='wanType' class='radioSwitch'>
 <li class='button'>DHCP
 <li class='button'>Static
 <li class='button'>Disabled
</ul>

<br>

<input type="checkbox" id="wanToggle" class="slideToggle" />
<label class="slideToggleViewport" for="wanToggle">
 <div class="slideToggleSlider">
  <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
  <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>WAN</span></div>
  <div class="slideToggleContent slideToggleRight button"><span>LAN</span></div>
 </div>
</label>

<br>

 <div id='dhcpRange'>
  DHCP Range: <input id='dhcpRangeMin' name='dhcpRangeMinValue' /> - <input id='dhcpRangeMax' name='dhcpRangeMaxValue' />
  <div id='dhcpRangeSlider' class='rangeSlider'></div>
 </div>

</div>
<div id='demo' class='controlBox'>
</div>

<?php
 echo preg_replace(
  array("/^/m","/\n/m"),
  array("<div class='controlBox'>","</div>\n"),
  file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/libs/lorem.txt')
 );
?>
<script type='text/ecmascript'>

$(function(){
 $('.radioSwitch > li').click(shortSwitchSelect);


/* Slider with Spinners BEGIN */
 var dhcpRangeMin = 0;
 var dhcpRangeMax = 254;
 var dhcpRangeLower = 100;
 var dhcpRangeUpper = 199;

 $( '#dhcpRangeMin' ).spinner({
  min: dhcpRangeMin,
  max: dhcpRangeUpper,
  spin: function(event, ui){
   $('#dhcpRangeSlider').slider('values', '0', ui.value);
   $('#dhcpRangeMax').spinner('option','min', ui.value );
  },
  change: function(event,ui){
   if( $(this).val() < $(this).spinner('option','min') ) $(this).val( $(this).spinner('option','min') );
   if( $(this).val() > $(this).spinner('option','max') ) $(this).val( $(this).spinner('option','max') );
   $('#dhcpRangeSlider').slider('values', '0', $(this).val());
  }
 });

 $( '#dhcpRangeMax' ).spinner({
  min: dhcpRangeLower,
  max: dhcpRangeMax,
  spin: function(event, ui){
   $('#dhcpRangeSlider').slider('values', '1', ui.value);
   $('#dhcpRangeMin').spinner('option','max', ui.value );
  },
  change: function(event,ui){
   if( $(this).val() < $(this).spinner('option','min') ) $(this).val( $(this).spinner('option','min') );
   if( $(this).val() > $(this).spinner('option','max') ) $(this).val( $(this).spinner('option','max') );
   $('#dhcpRangeSlider').slider('values', '1', $(this).val());
  }
 });

 $('#dhcpRangeSlider').slider({
  range: true,
  min: dhcpRangeMin,
  max: dhcpRangeMax,
  values: [dhcpRangeLower,dhcpRangeUpper],
  slide: function(event, ui){
   $('#dhcpRangeMin').val(ui.values[0]);
   $('#dhcpRangeMax').val(ui.values[1]);
   $('#dhcpRangeMin').spinner('option','max', ui.values[1] );
   $('#dhcpRangeMax').spinner('option','min', ui.values[0] );
  }
 });

 $('#dhcpRangeMin').val( $( '#dhcpRangeSlider' ).slider( 'values', 0 ) );
 $('#dhcpRangeMax').val( $( '#dhcpRangeSlider' ).slider( 'values', 1 ) );

// $('#demo').html('<pre>'+ what($('#dhcpRangeSlider')) +'</pre>');


/* Slider with Spinners END */
});
</script>
