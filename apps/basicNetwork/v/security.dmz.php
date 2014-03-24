<div class='pageTitle'>Security: DMZ</div>
<!-- TODO: -->

<div class='controlBox'><span class='controlBoxTitle'>DMZ</span>
	<div class='controlBoxContent' id='dmz'>

		<input type="checkbox" id="dmzToggle" name='dmzToggle' class="slideToggle"/>
		<label class="slideToggleViewport" for="dmzToggle">
			<div class="slideToggleSlider">
			  <div class="slideToggleButton slideToggleButtonBackground">&nbsp;</div>
			  <div class="slideToggleContent slideToggleLeft button buttonSelected"><span>On</span></div>
			  <div class="slideToggleContent slideToggleRight button"><span>Off</span></div>
			</div>
		</label>
		
	</div>
</div>


<script type='text/ecmascript' src='php/etc.php?q=dmz'></script>
<script type='text/ecmascript'>

	$('#destination').ipspinner().ipspinner('value',dmz.destination).spinner({
    disabled: true
   });

	$("input[name=dmzToggle]").change(function(){

		if( $("input[name=dmzToggle]").is(":checked") ) {
	    $("input[name=destination]").attr("disabled", false).spinner({
	      disabled: false
	    });
	    $("input[name=restriction]").attr("disabled", false);
		} else {
		$("input[name=destination]").attr("disabled", true).spinner({
		  disabled: true
		});
		
		$("input[name=restriction]").attr("disabled", true);
		}

	});


	$.widget("jai.dmz", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
    $(this.element)
    .append( $(document.createElement('table'))
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Destination Address') 
          )
          .append( $(document.createElement('td'))
          	.append( $(document.createElement('input') )
          	.prop('name', 'dmz_destination') ) 
          )
        )
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Destination Restriction') 
          )
          .append( $(document.createElement('td'))
          	.append( $(document.createElement('input') )
          		.prop('name', 'dmz_drestriction')  
          	)
          )
        )  //end tr
      ) //end tbody
		) //end system table
   	.append( $(document.createElement('div'))
   		.append( $(document.createElement('span')).addClass('xsmallText')
   			.html('(optional; ex: "1.1.1.1", "1.1.1.0/24", "1.1.1.1 - 2.2.2.2" or "me.example.com")')
   		)
   	) //end div
	}
})

$(function(){
  //instatiate widgets on document ready
  $('#dmz').dmz();
})

</script>