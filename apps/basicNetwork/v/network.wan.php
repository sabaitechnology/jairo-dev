<div class='pageTitle'>Network: WAN</div>
<!--	TODO:
WAN PPPoE { username, password, options, mode/interval } and IPv6
DDNS: { ip, interval, services }
-->
<div class='controlBox'><span class='controlBoxTitle'>WAN</span>
	<!-- this div gets populated by widget -->
  <div class='controlBoxContent' id='wansetup'>
	</div>
</div>

<div class='controlBox'>
	<span class='controlBoxTitle'>DNS</span>
	<div class='controlBoxContent'>
		<table class='controlTable'>
			<tbody>
			<tr>
				<td>DNS Servers</td>
				<td><div><ul id='dns_servers'></ul></div></td>
				<td class="description">
					<div id='editableListDescription'>
						<span class ='xsmallText'>(These are the DNS servers the DHCP server will provide for devices also on the LAN)
						</span>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
<input type='button' value='Save' id='save'>
<pre id='testing'>
</pre>



<script type='text/ecmascript' src='php/etc.php?q=wan,dns'></script>
<script type='text/ecmascript'>

var pForm = {}

function spinnerConstraint(spinner){
  var curv = $(spinner).ipspinner('value');
  if( curv < $(spinner).ipspinner('option','min') ) 
    $(spinner).ipspinner('value', $(spinner).ipspinner('option','min') );
  else if( curv > $(spinner).ipspinner('option','max') ) 
    $(spinner).ipspinner('value', $(spinner).ipspinner('option','max') );
}


$.widget("jai.wansetup", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('WAN Type') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select'))
                .prop("id","wan_type")
                .prop("name","wan_type")
                .prop("class", "radioSwitchElement")
            	.append( $(document.createElement('option'))
            		.prop("value", "dhcp")
            		.prop("text", 'DHCP')
            	)
            	.append( $(document.createElement('option'))
            		.prop("value", "static")
            		.prop("text", 'Static')
            	)
            	.append( $(document.createElement('option'))
            		.prop("value", "lan")
            		.prop("text", 'LAN')
            	)
            	.append( $(document.createElement('option'))
            		.prop("value", "disabled")
            		.prop("text", 'Disabled')
            	)
            )

          )
        ) // end type tr
      ) // end first tbody
      .append( $(document.createElement('tbody')).addClass("wan_type wan_type-static") 
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('IP') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","wan_ip")
                .prop("name","wan_ip")
                .prop("type","text")
            )
          )
        ) // end ip row
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('Network Mask') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","wan_mask")
                .prop("name","wan_mask")
                .prop("type","text")
            )
          )
        ) // end nmask row
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('Gateway') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","wan_gateway")
                .prop("name","wan_gateway")
                .prop("type","text")
            )
          )
        ) // end gateway row
      ) // end 2nd table body
      .append( $(document.createElement('tbody')) 
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('MTU') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","wan_mtu")
                .prop("name","wan_mtu")
                .prop("type","text")
            )
          )
        ) //end MTU row
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('MAC') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","wan_mac")
                .prop("name","wan_mac")
                .prop("type","text")
            )
          )
        ) //end Mac row
      ) // end bottom table body
    ) // end table


   


    // call ipspinner widget
    $('#wan_ip').ipspinner({
      min: '10.0.0.1', max: '10.255.255.254',
      page: Math.pow(2,(32-mask2cidr(this.options.conf.mask))),
      change: function(event,ui){ 
        spinnerConstraint(this);
      }
    }).ipspinner('value',this.options.conf.ip);

    // call maskspinner widget
    $('#wan_mask').maskspinner({
      spin: function(event,ui){ 
        $('#wan_ip').ipspinner('option','page', Math.pow(2,(32-ui.value)) ) 
      }
    }).maskspinner('value',this.options.conf.mask);


  	$('#wan_mac').macspinner().macspinner('value',wan.mac);
		$('#wan_mtu').spinner({ min: 0, max: 1500 }).spinner('value',wan.mtu);
		$('#wan_gateway').ipspinner().ipspinner('value',wan.gateway);
		$('#wan_mask').maskspinner().maskspinner('value',wan.mask);
		$('#wan_ip').ipspinner().ipspinner('value',wan.ip);
		$('#wan_type').radioswitch({ value: wan.type, hasChildren: true });

		
	  this._super();
  },

  //global save method
  saveWAN: function(){  
  
    var rawForm = $('#wansetup input').serializeArray();
    for(var i in rawForm){
      pForm[ rawForm[i].name ] = rawForm[i].value;
    }
    $('#testing').html( rawForm )
    console.log(pForm)
    return pForm;
 
  }
});

$(function(){
  //instatiate widgets on document ready
  $('#wansetup').wansetup({ conf: wan });
	$('#dns_servers').oldeditablelist({ list: dns.servers, fixed: true })
})

$('#save').click( function() {
  //FIGURE OUT HOW TO join pforms
  $('#wansetup').wansetup('saveWAN')
  toServer(pForm, 'save');
});  





</script>
