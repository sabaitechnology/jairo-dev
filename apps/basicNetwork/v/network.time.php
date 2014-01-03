<div class='pageTitle'>Network: Time</div>

<div class='controlBox'><span class='controlBoxTitle'>NTP</span>
  <div class='controlBoxContent'>
    <table class='controlTable'><tbody>
      <tr>
        <td>Server Pool</td>
        <td><ul id='ntp_servers'></ul>
        </td>
      </tr>
      <!-- tr><td>Time Zone</td><td>
       <input type='hidden' id='ntp_zone' name='ntp_zone'>
       <span id='ntp_zone_text'></span>
       <div id='ntp_zone_menu' class='noshow'>< !- ?php include('php/timezones.php'); ? -></div>
       <br>Automatic DST <input id='ntp_autodst' name='ntp_autodst' type='checkbox'>
      </td></tr>
      <tr><td>Update Interval</td><td>

       <input id='ntpLower' name='ntpLower' /> - <input id='ntpUpper' name='ntpUpper' />
       <div id='ntpSlider' class='rangeSlider'></div>

      </td></tr>
      <tr><td>Current Time</td><td>
       <input id='ntp_time' name='ntp_time' />
      </td></tr>
      <tr><td>Current Date</td><td>
       <input id='ntp_date' name='ntp_date' />
      </td></tr -->
    </tbody></table>
  </div>
</div>


<script type='text/ecmascript' src='php/etc.php?q=ntp&time=current'></script>
<script type='text/ecmascript' src='/libs/globalize.js'></script>
<script type='text/ecmascript'>

  //function showZones(){ $('#ntp_zone_text').hide(); $('#ntp_zone_menu').show(); }
  // makeEditableList(ntp.servers,'#ntp_server_list','#ntp_servers');

  function testSub(){
    $('#demo').html('Sent: '+$('#fe').serialize() +'\n');
    $.ajax("php/test.php",{
      type: "POST",
      dataType: "text",
      data: $('#fe').serialize(),
      complete: function(r,s){
       $('#demo').append( s+':\n'+r.responseText );
      }
    })
  }

  $('#ntp_servers').oldeditablelist({ list: ntp.servers });

  function logEvent(event,ui){ 
    $('#demo').append( event.type +'\n' ); 
  }
  /*
  $('#ntp_server_list').html( $.map(ntp.servers,function(v,i){ return "<li>"+ v +"</li>"; }).join('') ).sortable({
   forcePlaceholderSize: true,
   forceHelperSize: true,
   placeholder: "editableListPlaceholder",
   create: function(event,ui){ makeEditable($(this).children('li')); }
  });
  */
  /* Slider with Spinners BEGIN */
  /*
   $('#ntpLower').spinner({
    min: 6, max: ntp.upper,
    spin: function(event, ui){
     $('#ntpSlider').slider('values', '0', ui.value);
     $('#ntpUpper').spinner('option','min', ui.value );
    },
    change: function(event,ui){ // spinnerConstraint(this);
     var curv = $(this).spinner('value');
     $('#ntpSlider').slider('values', '0', curv );
     $('#ntpUpper').spinner('option','min', curv );
    }
   })

   $('#ntpUpper').spinner({
    min: ntp.lower, max: 17,
    spin: function(event, ui){
     $('#ntpSlider').slider('values', '1', ui.value);
     $('#ntpLower').spinner('option','max', ui.value );
    },
    change: function(event,ui){ //spinnerConstraint(this);
     var curv = $(this).spinner('value');
     $('#ntpSlider').slider('values', '1', curv );
     $('#ntpLower').spinner('option','max', curv );
    }
   })

   $('#ntpSlider').slider({
    range: true,
    min: 6,
    max: 17,
    values: [ntp.lower,ntp.upper],
    slide: function(event, ui){
     $('#ntpLower').spinner('value',ui.values[0]);
     $('#ntpUpper').spinner('value',ui.values[1]);
     $('#ntpLower').spinner('option','max', ui.values[1] );
     $('#ntpUpper').spinner('option','min', ui.values[0] );
    }
   });

   $('#ntpLower').spinner('value', ntp.lower );
   $('#ntpUpper').spinner('value', ntp.upper );
  */
  /* Slider with Spinners END */
  /*
   $('#ntp_time').timespinner();
   $('#ntp_date').datepicker();
   $('#ntp_zone_text').html(ntp.zone).click(showZones);
  */
  // $(function(){
  // $('#ntp_time').timespinner('value', current[3] +':'+ current[4] +' '+ current[5]);
  // $('#ntp_date').datepicker('setDate', current[1] +'/'+ current[2] +'/'+ current[0]);
  /*
   $('#ntp_zone_menu > ul').menu({
    select: function(event, ui){ var newTimeZone = ui.item.attr('data-zone');
     $('#ntp_zone').val(newTimeZone);
     $('#ntp_zone_text').html( newTimeZone ).show();
     $('#ntp_zone_menu').hide();
    }
   });
  */
  /*
   $('#ntp_zone').hideespinner({
    min: 0,
    max: 20
   }).hideespinner('value', 10);
  */
  // });
</script>
