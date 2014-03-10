<div class='pageTitle'>Network: Status</div>
<!--	TODO:

-->
</div>
<div class='controlBox'><span class='controlBoxTitle'>System</span>
	<!-- this div gets populated by widget -->
  <div class='controlBoxContent' id='systemstatus'>
	</div>
</div>
<div class='controlBox'><span class='controlBoxTitle'>WAN</span>
	<!-- this div gets populated by widget -->
  <div class='controlBoxContent' id='wanstatus'>
	</div>
</div>
<div class='controlBox'><span class='controlBoxTitle'>LAN</span>
	<!-- this div gets populated by widget -->
  <div class='controlBoxContent' id='lanstatus'>
	</div>
</div>
<div class='controlBox'><span class='controlBoxTitle'>Wireless</span>
	<!-- this div gets populated by widget -->
  <div class='controlBoxContent' id='wirelessstatus'>
	</div>
</div>


<script type='text/ecmascript' src='php/diagnostics.route.php'></script>
<script type='text/ecmascript'>


$.widget("jai.systemstatus", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')).addClass("smallText") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Name') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Model') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Time') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Uptime') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('CPU Load') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Total/Free Memory') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
      ) //end tbody
		) //end system table
	}
})

$.widget("jai.wanstatus", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')).addClass("smallText") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('MAC Address') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Connection Type') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('IP Address') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Subnet Mask') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Gateway') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('DNS') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('MTU') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Status') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Connection Uptime') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Remaining Lease Time') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
      ) //end tbody
		) //end wan table
	}
})

$.widget("jai.lanstatus", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')).addClass("smallText") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Router MAC Address') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Router UP Address') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Subnet Mask') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('DHCP') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
      ) //end tbody
		) //end lan table
	}
})


$.widget("jai.wirelessstatus", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')).addClass("smallText") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('MAC Address') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Wireless Mode') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Wireless Network Mode') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Radio') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('SSID') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Security') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Channel') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Chennel Width') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Interference Level') 
          )
          .append( $(document.createElement('td')).html('_______') 
          )
        )
      ) //end tbody
		) //end system table
	}
})

$(function(){
  //instatiate widgets on document ready
  $('#systemstatus').systemstatus();
  $('#wanstatus').wanstatus();
  $('#lanstatus').lanstatus();
  $('#wirelessstatus').wirelessstatus();

})



</script>