<div class='pageTitle'>Wireless: Radio</div>
<!--	TODO: align td widths-->

<div class='controlBox'><span class='controlBoxTitle'>WL0</span>
  <div class='controlBoxContent' id='wl_wl0'>
  </div>
</div>

<pre id="testing"></pre>

<script type='text/ecmascript' src='php/etc.php?q=wl&n=0'></script>
<script type='text/ecmascript'>

var pForm = {}

$.widget("jai.wl_wl0", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable smallwidth")
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Mode') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select'))
                .prop("id","wl_type")
                .prop("name","wl_type")
                .prop("class", "radioSwitchElement")
              .append( $(document.createElement('option'))
                .prop("value", "off")
                .prop("text", 'Off')
              )
              .append( $(document.createElement('option'))
                .prop("value", "server")
                .prop("text", 'Wireless Server')
              )
              .append( $(document.createElement('option'))
                .prop("value", "client")
                .prop("text", 'Wireless Client')
              )
            )
          )
        ) // end mode tr

        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('SSID') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select'))
                .prop("id","wl_security")
                .prop("name","wl_security")
                .prop("class", "radioSwitchElement")
              .append( $(document.createElement('option'))
                .prop("value", "none")
                .prop("text", 'None')
              )
              .append( $(document.createElement('option'))
                .prop("value", "wep")
                .prop("text", 'WEP')
              )
              .append( $(document.createElement('option'))
                .prop("value", "wpapersonal")
                .prop("text", 'WPA Personal')
              )
            )
          )
        ) // end ssid tr
      ) // end first tbody
    ) // end table

    // LOWER TABLE, DEPENDS ON SECURITY SELECTION
    //wep table body
    .append( $(document.createElement('table')).addClass("controlTable indented")
      .append( $(document.createElement('tbody')).addClass("wl_security wl_security-wep") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('WEP Keys') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('ul')).prop("id","wl_wep_keys")
            )
          )
        ) // end WEP keys tr
      ) // end WEP tbody

      //wpa tbody
      .append( $(document.createElement('tbody')).addClass("wl_security wl_security-wpapersonal") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('&nbsp') 
          )
          .append( $(document.createElement('td')).html('&nbsp') 
          )
        ) // end empty tr

        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('WPA Type') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select'))
                .prop("id","wl_wpa_type")
                .prop("name","wl_wpa_type")
                .prop("class", "radioSwitchElement")
              .append( $(document.createElement('option'))
                .prop("value", "1")
                .prop("text", 'WPA')
              )
              .append( $(document.createElement('option'))
                .prop("value", "2")
                .prop("text", 'WPA2')
              )
              .append( $(document.createElement('option'))
                .prop("value", "3")
                .prop("text", 'WPA/WPA2')
              )
            )
          )
        ) // end WPA type tr

        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('WPA Type') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select'))
                .prop("id","wl_wpa_encryption")
                .prop("name","wl_wpa_encryption")
                .prop("class", "radioSwitchElement")
              .append( $(document.createElement('option'))
                .prop("value", "1")
                .prop("text", 'AES')
              )
              .append( $(document.createElement('option'))
                .prop("value", "2")
                .prop("text", 'TKIP')
              )
              .append( $(document.createElement('option'))
                .prop("value", "3")
                .prop("text", 'AES/TKIP')
              )
            )
          )
        ) // end WPA type tr

        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('PSK') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('input'))
                .prop("id","wl_wpa_psk")
                .prop("name","wl_wpa_psk")
            )
          )
        ) // end PSK tr

        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Key Duration') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('input'))
                .prop("id","wl_wpa_rekey")
                .prop("name","wl_wpa_rekey")
            )
          )
        ) // end PSK tr
      ) // end WPA tbody
    ) // end lower table
    .append( $(document.createElement('input'))
      .prop("type", "button")
      .prop("id", "save")
      .prop("value", "Save")
    )

	$('#wl_security').change(function(){
		console.log('you clicked security')
		$('.wl_security').hide(); 
		$('.wl_security-'+ $('#wl_security').val() ).show(); 
	})

	$('#wl_type').radioswitch({
		value: wl[0].type,
		change: function(event,ui){ 
			$('.wl_type').hide(); 
			$('.wl_type-'+ wl[0].security ).show(); 
		}
	});

	$('#wl_ssid').val(wl[0].ssid);

	$('#wl_security').radioswitch({
		value: wl[0].security
	});

	$('#wl_wpa_type').radioswitch({
	 value: wl[0].wpa.type
	});

	$('#wl_wpa_encryption').radioswitch({
	 value: wl[0].wpa.encryption
	});

	$('#wl_wpa_psk').val(wl[0].wpa.psk);

	//$('#wl_wpa_rekey').val(wl[0].wpa.rekey);

	$('#wl_wpa_rekey').spinner({ min: 0, max: 525600 }).spinner('value',wl[0].wpa.rekey);

	$('#wl_wep_keys').oldeditablelist({ list: wl[0].wep.keys, fixed: true });

    
    this._super();
  },

  //global save method
  saveWL0: function(){  

    //   $('#save').click( function() {
  //     var rawForm = $('#fe').serializeArray()
  //     var pForm = {}
  //     for(var i in rawForm){
  //       pForm[ rawForm[i].name ] = rawForm[i].value;
  //     }
  //     // if(!pForm['dhcp_on']) pForm['dhcp_on'] = 'off'
  // //    $('#testing').html( JSON.stringify(pForm) )
  //     toServer(pForm, 'save');
  //   }); 
  
    var rawForm = $('#wl_wl0 input').serializeArray();
    for(var i in rawForm){
      pForm[ rawForm[i].name ] = rawForm[i].value;
    }
    $('#testing').html( rawForm )
    console.log(pForm)
    return pForm;
 
  } //end save WL0
});

$(function(){
  //instatiate widgets on document ready
  $('#wl_wl0').wl_wl0({ conf: wl });
})

$('#save').click( function() {
  //FIGURE OUT HOW TO join pforms
  $('#wl_wl0').wl_wl0('saveWL0')
  toServer(pForm, 'save');
});  




</script>
