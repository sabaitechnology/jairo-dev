<div class='pageTitle'>Network: LAN</div>
<!-- TODO:
WINS?
ADD VALIDATION
Don't allow multiple lan widgets on same page if htey are all operating on the same thing
-->

<div class='controlBox'><span class='controlBoxTitle'>Address</span>
  <div class='controlBoxContent' id='lanaddress'>
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

<!--   
  ____            _       _       
 / ___|  ___ _ __(_)_ __ | |_ ___ 
 \___ \ / __| '__| | '_ \| __/ __|
  ___) | (__| |  | | |_) | |_\__ \
 |____/ \___|_|  |_| .__/ \__|___/
                   |_|            
-->
<script type='text/ecmascript' src='php/etc.php?q=lan,dhcp'></script>
<script type='text/ecmascript'>

var pForm = {}

function spinnerConstraint(spinner){
  var curv = $(spinner).ipspinner('value');
  if( curv < $(spinner).ipspinner('option','min') ) 
    $(spinner).ipspinner('value', $(spinner).ipspinner('option','min') );
  else if( curv > $(spinner).ipspinner('option','max') ) 
    $(spinner).ipspinner('value', $(spinner).ipspinner('option','max') );
}


$.widget("jai.lanaddress", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable").prop("id","lanaddress") 
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('LAN IP') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('input'))
                .prop("id","lan_ip")
                .prop("name","lan_ip")
                .prop("type","text")
            )
          )
        )
        
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('LAN Mask') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","lan_mask")
                .prop("name","lan_mask")
                .prop("type","text")
            )
          )
        )
      )
    )

    // call ipspinner widget
    $('#lan_ip').ipspinner({
      min: '10.0.0.1', max: '10.255.255.254',
      page: Math.pow(2,(32-mask2cidr(this.options.conf.mask))),
      change: function(event,ui){ 
        spinnerConstraint(this);
      }
    }).ipspinner('value',this.options.conf.ip);

    // call maskspinner widget
    $('#lan_mask').maskspinner({
      spin: function(event,ui){ 
        $('#lan_ip').ipspinner('option','page', Math.pow(2,(32-ui.value)) ) 
      }
    }).maskspinner('value',this.options.conf.mask);

    //add to built-in widget functionality
    this._super();
  },

  //global save method
  saveLAN: function(){  
  
    var rawForm = $('#lanaddress input').serializeArray();
    for(var i in rawForm){
      pForm[ rawForm[i].name ] = rawForm[i].value;
    }
    $('#testing').html( rawForm )

    return pForm;
 
  }
});

$(function(){
  //instatiate widget on document ready
  $('#lanaddress').lanaddress({ conf: lan });
})


$('#save').click( function() {
  //FIGURE OUT HOW TO join pforms
  $('#lanaddress').lanaddress('saveLAN')
  toServer(pForm, 'save');
});  


var network = {}
var dhcpRangeMin = ip2long('10.0.0.1');
var dhcpRangeMax = ip2long('10.0.0.254');


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