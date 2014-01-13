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
  <div class='controlBoxContent' id='dhcpserver'>   
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
var pForm2 = {}


function spinnerConstraint(spinner){
  var curv = $(spinner).ipspinner('value');
  if( curv < $(spinner).ipspinner('option','min') ) 
    $(spinner).ipspinner('value', $(spinner).ipspinner('option','min') );
  else if( curv > $(spinner).ipspinner('option','max') ) 
    $(spinner).ipspinner('value', $(spinner).ipspinner('option','max') );
}

//  _      _   _  _   __      ___    _          _   
// | |    /_\ | \| |__\ \    / (_)__| |__ _ ___| |_ 
// | |__ / _ \| .` |___\ \/\/ /| / _` / _` / -_)  _|
// |____/_/ \_\_|\_|    \_/\_/ |_\__,_\__, \___|\__|
//                                    |___/         

$.widget("jai.lanaddress", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    
    // BUILDING DOM ELEMENTS
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




 //  ___  _  _  ___ ___   __      ___    _          _   
 // |   \| || |/ __| _ \__\ \    / (_)__| |__ _ ___| |_ 
 // | |) | __ | (__|  _/___\ \/\/ /| / _` / _` / -_)  _|
 // |___/|_||_|\___|_|      \_/\_/ |_\__,_\__, \___|\__|
 //                                       |___/         



$.widget("jai.dhcpserver", {
    
  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    $(this.element)
    .append( $(document.createElement('table')).addClass("controlTable").prop("id","dhcpserver") 
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Lease') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('input'))
                .prop("id","dhcp_lease")
                .prop("name","dhcp_lease")
                .prop("type","text")
            )
          )
        )
        
        .append( $(document.createElement('tr') )
          .append( $(document.createElement('td')).html('DHCP Range') )
          .append( $(document.createElement('td') )
            .append(
              $(document.createElement('input'))
                .prop("id","dhcp_lower")
                .prop("name","dhcp_lower")
                .prop("type","text")
            )
          )
          .append(
              $(document.createElement('input'))
                .prop("id","dhcp_upper")
                .prop("name","dhcp_upper")
                .prop("type","text")
            )
        )    
      )
    )

    // call ipspinner widget
    var network = {}
    var dhcpRangeMin = ip2long('10.0.0.1');
    var dhcpRangeMax = ip2long('10.0.0.254');

    $('#dhcp_lease').spinner();
    $('#dhcp_upper').ipspinner();
    $('#dhcp_lower').ipspinner();



    $('#dhcp_lower').ipspinner({
      min: dhcpRangeMin, max: this.options.conf.upper,
      spin: function(event, ui){
        // $('#dhcpSlider').slider('values', '0', ui.value);
        $('#dhcp_upper').ipspinner('option','min', ui.value );
      },
      change: function(event,ui){ 
        spinnerConstraint(this);
        //var curv = $(this).ipspinner('value');
        //if( curv < $(this).ipspinner('option','min') ) $(this).ipspinner('value', $(this).ipspinner('option','min') );
        //else if( curv > $(this).ipspinner('option','max') ) $(this).ipspinner('value', $(this).ipspinner('option','max') );
        var curv = $(this).ipspinner('value');
        //$('#dhcpSlider').slider('values', '0', curv );
        $('#dhcp_upper').ipspinner('option','min', curv );
      }
    })


    // TODO: Surely there's a better way! (insert infomercial here)
    //  $("#dhcpEdit").attr("checked", false)
    //set initial valies for lease/range inputs
    $('#dhcp_lease').spinner({ min: 0, max: 525600 });
    $('#dhcp_lease').spinner('value',86400);
    $('#dhcp_lower').ipspinner('value', this.options.conf.lower );
    
    
    $('#dhcp_upper').ipspinner('value', this.options.conf.upper );


    // $('#dhcp_lease').spinner('option','disabled', true );
    // $('#dhcp_upper').ipspinner('option','disabled', true );
    // $('#dhcp_lower').ipspinner('option','disabled', true );

    //add to built-in widget functionality
    this._super();
  },

  //global save method
  saveDHCP: function(){  
  
    var rawForm = $('#dhcpserver input').serializeArray();
    for(var i in rawForm){
      pForm2[ rawForm[i].name ] = rawForm[i].value;
    }
    $('#testing').append( rawForm )
    console.log(pForm2)
    return pForm2;
 
  }
});

$(function(){
  //instatiate widgets on document ready
  $('#lanaddress').lanaddress({ conf: lan });
  $('#dhcpserver').dhcpserver({ conf: dhcp });
})

$('#save').click( function() {
  //FIGURE OUT HOW TO join pforms
  $('#lanaddress').lanaddress('saveLAN')
  $('#dhcpserver').dhcpserver('saveDHCP')
  toServer(pForm, 'save');
});  


</script>