<form id='fe'>

<div class='pageTitle'>Wireless: Radio</div>
<!--	TODO: align td widths-->

<div class='controlBox'><span class='controlBoxTitle'>WL0</span>
  <div class='controlBoxContent'>
    <!-- TOP TABLE -->
    <table class='controlTable smallwidth'><tbody>
      <tr>
        <td>Mode
        </td>
        <td>
          <select id='wl_type' name='wl_type' class='radioSwitchElement'>
            <option value='off'>Off</option>
            <option value='server'>Wireless Server</option>
            <option value='client'>Wireless Client</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>SSID</td>
        <td><input id='wl_ssid' name='wl_ssid' />
        </td>
      </tr>
      <tr>
        <td>Security</td>
        <td>
          <select id='wl_security' name='wl_security' class='radioSwitchElement'>
            <option value='none'>None</option>
            <option value='wep'>WEP</option>
            <option value='wpapersonal'>WPA Personal</option>
          </select>
        </td>
      </tr>
    </tbody></table>

    <!-- LOWER TABLE, DEPENDS ON SECURITY SELECTION -->
    <table class='controlTable indented'>      
      <!-- WEP OPTION -->
      <tbody class='wl_security wl_security-wep'>
        <tr>
          <td>WEP Keys
          </td>
          <td>
            <ul id='wl_wep_keys'></ul>
          </td>
        </tr>
      </tbody> 
      
      <!-- WPA OPTION -->
      <tbody class='wl_security wl_security-wpapersonal'> 
        <tr>
          <td>&nbsp</td>
          <td>&nbsp</td>
        </tr>
        <tr>
          <td>WPA Type</td>
          <td>
            <select id='wl_wpa_type' name='wl_wpa_type' class='radioSwitchElement'>
              <option value='1'>WPA</option>
              <option value='2'>WPA2</option>
              <option value='3'>WPA/WPA2</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>WPA Encryption</td>
          <td>
            <select id='wl_wpa_encryption' name='wl_wpa_encryption' class='radioSwitchElement'>
              <option value='1'>AES</option>
              <option value='2'>TKIP</option>
              <option value='3'>AES/TKIP</option>
            </select>
         </td>
        </tr>
        <tr>
          <td>PSK
          </td>
          <td><input id='wl_wpa_psk' name='wl_wpa_psk' />
          </td>
        </tr>
        <tr>
          <td>Key Duration</td>
          <td><input id='wl_wpa_rekey' name='wl_wpa_rekey' />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<input type='button' id='save' value='Save'>


<script type='text/ecmascript' src='php/etc.php?q=wl&n=0'></script>
<script type='text/ecmascript'>

  $('#save').click( function() {
    var rawForm = $('#fe').serializeArray()
    var pForm = {}
    for(var i in rawForm){
      pForm[ rawForm[i].name ] = rawForm[i].value;
    }
    // if(!pForm['dhcp_on']) pForm['dhcp_on'] = 'off'
//    $('#testing').html( JSON.stringify(pForm) )
    toServer(pForm, 'save');
  }); 
  
// $(function() {

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

  //$('#wanmtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
  //$('#wanmac').val(wan.mac);
// })
</script>
</form>
