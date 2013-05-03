<div class='pageTitle'>Network: Wan</div>
<div class='controlBox'>

<!--

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
-->

DHCP Server
Range
Lease time
WINS?
LAN DNS Servers | Use WAN
<br>
<br>

Lan IP: <input id='lanip' name='lanipValue' /><br>
Mask: <input id='lanmask' name='lanmaskValue' /><br>


<input type="checkbox" id="dhcpToggle" class="slideToggle" />
<label class="slideToggleViewport" for="dhcpToggle">
 <div class="slideToggleSlider">
  <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
  <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
  <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
 </div>
</label>

 <div id='dhcpRange'>
  DHCP Range: <input id='dhcpRangeMin' name='dhcpRangeMinValue' /> - <input id='dhcpRangeMax' name='dhcpRangeMaxValue' />
  <div id='dhcpRangeSlider' class='rangeSlider'></div>
 </div>

</div>

<div class='controlBox'>
<pre id='demo'></pre>
</div>

<script type='text/ecmascript'>
 var lan = {
  ip: '10.0.0.1',
  iplower: '10.0.0.1',
  ipupper: '10.255.255.254',
  mask: '255.255.255.0',
 }

 var dhcpRangeMin = ip2long('10.0.0.1');
 var dhcpRangeMax = ip2long('10.0.0.254');
 var dhcpRangeLower = ip2long('10.0.0.100');
 var dhcpRangeUpper = ip2long('10.0.0.199');


$(function(){

$('#lanip').ipspinner({
 min: ip2long(lan.iplower),
 max: ip2long(lan.ipupper),
 page: Math.pow(2,(32-lan.mask))
}).ipspinner('value',lan.ip);

$( '#lanmask' ).maskspinner({
 spin: function(event,ui){ $('#lanip').ipspinner('option','page', Math.pow(2,(32-ui.value)) ) }
}).val(lan.mask);

/* Slider with Spinners BEGIN */

 $( '#dhcpRangeMin' ).ipspinner({
  min: dhcpRangeMin,
  max: dhcpRangeUpper,
  spin: function(event, ui){
   $('#dhcpRangeSlider').slider('values', '0', ui.value);
   $('#dhcpRangeMax').ipspinner('option','min', ui.value );
  },
  change: function(event,ui){
   if( $(this).ipspinner('value') < $(this).ipspinner('option','min') ) $(this).ipspinner('value', $(this).ipspinner('option','min') );
   if( $(this).ipspinner('value') > $(this).ipspinner('option','max') ) $(this).ipspinner('value', $(this).ipspinner('option','max') );
   if(typeof event.originalEvent !== 'undefined' && event.originalEvent.type == 'blur' ) $('#dhcpRangeSlider').slider('values', '0', $(this).ipspinner('value') );
  }
 });

 $( '#dhcpRangeMax' ).ipspinner({
  min: dhcpRangeLower,
  max: dhcpRangeMax,
  spin: function(event, ui){
   $('#dhcpRangeSlider').slider('values', '1', ui.value);
   $('#dhcpRangeMin').ipspinner('option','max', ui.value );
  },
  change: function(event,ui){
   if( $(this).ipspinner('value') < $(this).ipspinner('option','min') ) $(this).ipspinner('value', $(this).ipspinner('option','min') );
   if( $(this).ipspinner('value') > $(this).ipspinner('option','max') ) $(this).ipspinner('value', $(this).ipspinner('option','max') );
   if(typeof event.originalEvent !== 'undefined' && event.originalEvent.type == 'blur' ) $('#dhcpRangeSlider').slider('values', '1', $(this).ipspinner('value') );
  }
 });

 $('#dhcpRangeSlider').slider({
  range: true,
  min: dhcpRangeMin,
  max: dhcpRangeMax,
  values: [dhcpRangeLower,dhcpRangeUpper],
  slide: function(event, ui){
   $('#dhcpRangeMin').ipspinner('value',ui.values[0]);
   $('#dhcpRangeMax').ipspinner('value',ui.values[1]); //value(ui.values[1]);
   $('#dhcpRangeMin').ipspinner('option','max', ui.values[1] );
   $('#dhcpRangeMax').ipspinner('option','min', ui.values[0] );
  }
 });

 $('#dhcpRangeMin').ipspinner('value', dhcpRangeLower );
 $('#dhcpRangeMax').ipspinner('value', dhcpRangeUpper );

/* Slider with Spinners END */
});

function monitor(thing){
$('#demo').html(
 thing +'\n'
 +'Limits: '+ dhcpRangeMin +','+ dhcpRangeMax +'\n'
 +'Range: '+ dhcpRangeLower +','+ dhcpRangeUpper +'\n'
 +'Slide: '+ $('#dhcpRangeSlider').slider('values').join(',') +'\n'
 +'Spins: '+ $('#dhcpRangeMin').ipspinner('value') +','+ $('#dhcpRangeMax').ipspinner('value') +'\n'
);
}

</script>
