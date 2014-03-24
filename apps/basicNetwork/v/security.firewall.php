<div class='pageTitle'>Security: Firewall</div>

<div class='controlBox'><span class='controlBoxTitle'>Firewall</span>
	<div class='controlBoxContent' id='firewall'>
<!-- 		<table>
			<tr><td>Respond to ICMP ping</td>
				<td><input type="checkbox" id="respondToggle" name='respondToggle' class="slideToggle" />
					 <label class="slideToggleViewport" for="respondToggle">
					 <div class="slideToggleSlider">
					   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
					   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
					   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
					  </div>
					 </label>
				</td>
			</tr>
			<tr><td>Allow multicast</td>
				<td><input type="checkbox" id="multicastToggle" name='multicastToggle' class="slideToggle" />
				 	<label class="slideToggleViewport" for="multicastToggle">
					 <div class="slideToggleSlider">
					   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
					   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
					   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
					  </div>
					</label>
				</td>
			</tr>
			<tr><td>Enable SYN cookies</td>
				<td><input type="checkbox" id="synToggle" name='synToggle' class="slideToggle" /> 
					<label class="slideToggleViewport" for="synToggle">
					 <div class="slideToggleSlider">
					   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
					   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
					   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
					  </div>
					 </label>
				</td>
			</tr>
			<tr><td>Enable WAN route input</td>
				<td><input type="checkbox" id="wanToggle" name='wanToggle' class="slideToggle" /> 
					<label class="slideToggleViewport" for="wanToggle">
					 <div class="slideToggleSlider">
					   <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
					   <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
					   <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
					  </div>
					 </label>
				</td>
			</tr>
		</table> -->
	</div>
</div>


<script type='text/ecmascript' src='php/etc.php?q=firewall'></script>
<script type='text/ecmascript'>

$.widget("jai.firewall", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')).addClass("smallText") 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Respond to ICMP ping') 
          )
          .append( $(document.createElement('td')).html('SLIDE TOGGLE') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Allow multicast') 
          )
          .append( $(document.createElement('td')).html('SLIDE TOGGLE') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Enable SYN cookies') 
          )
          .append( $(document.createElement('td')).html('SLIDE TOGGLE') 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Enable WAN route input') 
          )
          .append( $(document.createElement('td')).html('SLIDE TOGGLE') 
          )
        )
      ) //end tbody
		) //end system table
	}
})

	// $('#respondToggle').prop({'checked': firewall.icmp});
	// $('#multicastToggle').prop({'checked': firewall.multicast});
	// $('#synToggle').prop({'checked': firewall.cookies});
	// $('#wanToggle').prop({'checked':firewall.wan});

$(function(){
  //instatiate widgets on document ready
  $('#firewall').firewall();

})

</script>
