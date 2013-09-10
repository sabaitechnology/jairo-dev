<div class='pageTitle'>Security: Port Forwarding</div>


<div class='controlBox'><span class='controlBoxTitle'>Port Forwarding</span>
  <div class='controlBoxContent'>

  <table id='list' class='listTable'>

  </table>
  <br>
  <input type='button' value='Save' onclick='savePortForwarding();'>
  <input type='button' value='Cancel' onclick='cancelPortForwarding();'>
  <a id="toggleDesc" onclick="toggleExplain();" href="#"><span class='xsmallText'>Show Help</span></a><br>

  <ul id='help' class='nobullets noshow'>
  <span class='xsmallText'>
    <li><b>Proto - </b>Which protocol (tcp or udp) to forward.</li>
    <li><b>VPN - </b>Forward ports through the normal internet connection (WAN) or through the tunnel (VPN), or both. Note that the Gateways feature may result in may result in undefined behavior when devices routed through an interface have ports forwarded through a different interface. Additionally, ports will only be forwarded through the VPN when the VPN service is active. <li>
    <li><b>Src Address (optional) - </b>Forward only if from this address. Ex: "1.2.3.4", "1.2.3.4 - 2.3.4.5", "1.2.3.0/24", "me.example.com". </li>
    <li><b>Ext Ports - </b>The port(s) to be forwarded, as seen from the WAN. Ex: "2345", "200,300", "200-300,400". </li>
    <li><b>Int Port -</b> The destination port inside the LAN. Only one port per entry is supported.</li>
    <li><b>Int Address - </b>The destination address inside the LAN. </li>
  </span>
  </ul>



  </div>

</div>



<script type='text/ecmaascript'src='/libs/jquery.jeditable.checkbox.js'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt =  $('#list').dataTable({
    'bPaginate': false,
    'bInfo': false,
    "bProcessing": true,
    'sAjaxDataProp': 'portforwarding',
    'sAjaxSource': 'php/bin.security.portforwarding.php',
    'aoColumns': [
        { 'sTitle': 'On', 'mData':'On', 'sClass': 'checkbox'},  
        { 'sTitle': 'Proto',	'mData':'Proto', 'sClass':'drop' },
        { 'sTitle': 'VPN',		'mData':'VPN', 'sClass':'drop' },
        { 'sTitle': 'Src Address', 'mData':'Src Address'  },
        { 'sTitle': 'Ext Port',  'mData':'Ext Port' },
        { 'sTitle': 'Int Port',   'mData':'Int Port' },
        { 'sTitle': 'Int Address', 'mData':'Int Address'  },
        { 'sTitle': 'Description', 'mData':'Description'  }],
    'fnInitComplete': function(){
        $('.checkbox').editable(function(value, settings){
            var cPos = lt.fnGetPosition(this)
            lt.fnUpdate(value,cPos[0],cPos[1]);
            // lt.fnSetColumnVis( 0, false);
            //$('#demo').html( lt.fnGetPosition(this).join(',') );
            //$(this).editable()
            return value;
          },

          {
          'type':'checkbox',
          'cancel': 'Cancel',
          'submit': 'OK',
          'onblur':'submit',
          'event': 'dblclick',
          'checkbox': { trueValue: 'Yes', falseValue: 'No'}
          }
        ),
        $('td', this.fnGetNodes()).editable(function(value, settings){
            var cPos = lt.fnGetPosition(this)
            lt.fnUpdate(value,cPos[0],cPos[1]);
            // lt.fnSetColumnVis( 0, false);
            //$('#demo').html( lt.fnGetPosition(this).join(',') );
            //$(this).editable()
            return value;
          },

          {
           'onblur':'submit',
           'event': 'dblclick',
           'placeholder' : '',
          }
        ),
        $("input[type='checkbox']").change(function() {
            console.log("checked")
        })
    }
 });

function toggleExplain(){

  if( $("#toggleDesc").text()=="Show Help" ) {
      $("#help").show();
      $("#toggleDesc").text("Hide Help");

  } else {
      $("#help").hide();
      $("#toggleDesc").text("Show Help");
  }
};


</script>
