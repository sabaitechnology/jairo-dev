<div class='pageTitle'>Network: LAN</div>
<!-- TODO:
WINS?
ADD VALIDATION
-->

<div class='controlBox'><span class='controlBoxTitle'>Address</span>
  <div class='controlBoxContent'>
    <table class='controlTable'><tbody>
      <tr>
        <td>LAN IP</td><td><input id='lan_ip' name='lan_ip' /></td>
      </tr>
      <tr>
        <td>Mask</td><td><input id='lan_mask' name='lan_mask' /></td>
      </tr>
    </tbody></table>
  </div>
</div>

<div class='controlBox'><span class='controlBoxTitle'>DHCP Server</span>
  <div class='controlBoxContent'>
    <table  class='controlTable'><tbody>
      <tr><td colspan=2>
        <input type="checkbox" id="dhcp_on" name='dhcp_on' class="slideToggle"/>
        <label class="slideToggleViewport" for="dhcp_on">
          <div class="slideToggleSlider">
            <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
            <div class="slideToggleContent slideToggleLeft button buttonSelected">
              <span>On</span>
            </div>
            <div class="slideToggleContent slideToggleRight button">
              <span>Off</span>
            </div>
          </div>
        </label>
      </td></tr>
      <tr>
        <td>Lease</td>
        <td><input id='dhcp_lease' name='dhcp_lease'/></td>
      </tr>
      <tr>
        <td id='DHCPrange'>DHCP Range</td>
        <td>
          <input id='dhcp_lower' name='dhcp_lower'/> - <input id='dhcp_upper' name='dhcp_upper' />
          <!--  <div id='dhcpSlider' class='rangeSlider'></div> -->
        </td>
      </tr>
<!--       <tr>
        <td>
          <div id='editDiv' class='xsmallText'>
            <input id='dhcpEdit' name='dhcpEdit' type='checkbox' checked=false>Edit in "off" mode
          </div>
        </td>
      </tr> -->
    </tbody></table>
  </div>
</div>

<pre id='testing'>
</pre>

<input type='button' value='Save' id='save'>


<script type='text/ecmascript' src='php/etc.php?q=lan,dhcp'></script>
<script type='text/ecmascript'>
  
  $('#save').click( function() {
    var rawForm = $('#fe').serializeArray()
    var pForm = {}
    for(var i in rawForm){
      pForm[ rawForm[i].name ] = rawForm[i].value;
    }
    if(!pForm['dhcp_on']) pForm['dhcp_on'] = 'off'
//    $('#testing').html( JSON.stringify(pForm) )
    toServer(pForm, 'save');
  });  

  var network = {}
  var dhcpRangeMin = ip2long('10.0.0.1');
  var dhcpRangeMax = ip2long('10.0.0.254');

  function spinnerConstraint(spinner){
    var curv = $(spinner).ipspinner('value');
    if( curv < $(spinner).ipspinner('option','min') ) 
      $(spinner).ipspinner('value', $(spinner).ipspinner('option','min') );
    else if( curv > $(spinner).ipspinner('option','max') ) 
      $(spinner).ipspinner('value', $(spinner).ipspinner('option','max') );
  }

  $('#lan_ip').ipspinner({
    min: '10.0.0.1', max: '10.255.255.254',
    page: Math.pow(2,(32-mask2cidr(lan.mask))),
    change: function(event,ui){ spinnerConstraint(this);
    //  var curv = $(this).ipspinner('value');
    //  if( curv < $(this).ipspinner('option','min') ) $(this).ipspinner('value', $(this).ipspinner('option','min') );
    //  else if( curv > $(this).ipspinner('option','max') ) $(this).ipspinner('value', $(this).ipspinner('option','max') );
    }
  }).ipspinner('value',lan.ip);

  $( '#lan_mask' ).maskspinner({
    spin: function(event,ui){ $('#lan_ip').ipspinner('option','page', Math.pow(2,(32-ui.value)) ) }
  }).maskspinner('value',lan.mask);

  /* Slider with Spinners BEGIN */
  $('#dhcp_lower').ipspinner({
    min: dhcpRangeMin, max: dhcp.upper,
    spin: function(event, ui){
      // $('#dhcpSlider').slider('values', '0', ui.value);
      $('#dhcp_upper').ipspinner('option','min', ui.value );
    },
    change: function(event,ui){ spinnerConstraint(this);
      //var curv = $(this).ipspinner('value');
      //if( curv < $(this).ipspinner('option','min') ) $(this).ipspinner('value', $(this).ipspinner('option','min') );
      //else if( curv > $(this).ipspinner('option','max') ) $(this).ipspinner('value', $(this).ipspinner('option','max') );
      var curv = $(this).ipspinner('value');
      //$('#dhcpSlider').slider('values', '0', curv );
      $('#dhcp_upper').ipspinner('option','min', curv );
    }
  })

  $('#dhcp_upper').ipspinner({
    min: dhcp.lower, max: dhcpRangeMax,
    spin: function(event, ui){
      // $('#dhcpSlider').slider('values', '1', ui.value);
      $('#dhcp_lower').ipspinner('option','max', ui.value );
    },
    change: function(event,ui){ spinnerConstraint(this);
      //var curv = $(this).ipspinner('value');
      //if( curv < $(this).ipspinner('option','min') ) $(this).ipspinner('value', $(this).ipspinner('option','min') );
      //else if( curv > $(this).ipspinner('option','max') ) $(this).ipspinner('value', $(this).ipspinner('option','max') );
      var curv = $(this).ipspinner('value');
      $('#dhcpSlider').slider('values', '1', curv );
      $('#dhcp_lower').ipspinner('option','max', curv );
    }
   })

   // $('#dhcpSlider').slider({
   //  range: true,
   //  min: dhcpRangeMin,
   //  max: dhcpRangeMax,
   //  values: [ip2long(dhcp.lower),ip2long(dhcp.upper)],
   //  slide: function(event, ui){
   //   $('#dhcp_lower').ipspinner('value',ui.values[0]);
   //   $('#dhcp_upper').ipspinner('value',ui.values[1]);
   //   $('#dhcp_lower').ipspinner('option','max', ui.values[1] );
   //   $('#dhcp_upper').ipspinner('option','min', ui.values[0] );
   //  }
   // });

  /* Slider with Spinners END */

  // TODO: Surely there's a better way! (insert infomercial here)
//  $("#dhcpEdit").attr("checked", false)
  //set initial valies for lease/range inputs
  $(function(){
    $('#dhcp_lease').spinner({ min: 0, max: 525600 });
    $('#dhcp_lower').ipspinner('value', dhcp.lower );
    $('#dhcp_upper').ipspinner('value', dhcp.upper );
    $('#dhcp_lease').spinner('value',86400);

    $('#dhcp_lease').spinner();
    $('#dhcp_upper').ipspinner();
    $('#dhcp_lower').ipspinner();

    // $('#dhcp_lease').spinner('option','disabled', true );
    // $('#dhcp_upper').ipspinner('option','disabled', true );
    // $('#dhcp_lower').ipspinner('option','disabled', true );
  });

/*
  //when the on/off toggle changes
  $("#dhcp_on").change(function(){
    //if the toggle is set to on
    if( $("#dhcp_on").is(":checked") ) {
      //enable input, hide the edit in off mode
      $("#dhcp_lease").spinner( "option", "disabled", false );
      $("#dhcp_lower").ipspinner( "option", "disabled", false );
      $("#dhcp_upper").ipspinner( "option", "disabled", false );
      $("#editDiv").hide();
    } else {
      //otherwise disable inputs and show edit in off mode div
      $("#dhcp_lease").spinner( "option", "disabled", true );
      $("#dhcp_lower").ipspinner( "option", "disabled", true );
      $("#dhcp_upper").ipspinner( "option", "disabled", true );
      $("#editDiv").show();

    if( $("#dhcpEdit").is(":checked") ) {
        $("#dhcp_lease").spinner( "option", "disabled", false );
        $("#dhcp_lower").ipspinner( "option", "disabled", false );
        $("#dhcp_upper").ipspinner( "option", "disabled", false );
    } else {
        $("#dhcp_lease").spinner( "option", "disabled", true );
        $("#dhcp_lower").ipspinner( "option", "disabled", true );
        $("#dhcp_upper").ipspinner( "option", "disabled", true );
      }
    }
  });

  //of you check enable in off mode
  $("#dhcpEdit").change(function(){
    if( $("#dhcpEdit").is(":checked") ) {
      $("#dhcp_lease").spinner( "option", "disabled", false );
      $("#dhcp_lower").ipspinner( "option", "disabled", false );
      $("#dhcp_upper").ipspinner( "option", "disabled", false );
    } else {
      $("#dhcp_lease").spinner( "option", "disabled", true );
      $("#dhcp_lower").ipspinner( "option", "disabled", true );
      $("#dhcp_upper").ipspinner( "option", "disabled", true );
    }
  });
*/


</script>