<div class='pageTitle'>Wireless: Survey</div>
<!-- TODO: make the refresh/expirations actually do something-->

<div class='controlBox'>
  <span class='controlBoxTitle'>Wireless Site Survey</span>
  <div class='controlBoxContent' id='wirelesssurvey'>
    <pre id='result'></pre>
    <table id='list' class='listTable'></table>
    
  </div> 
</div> 

<script type='text/ecmascript'>

$.widget("jai.wirelesssurvey", {

  //Adding to the built-in widget constructor method - do this when widget is instantiated
  _create: function(){
    //TO DO: check to see if containing element has a unique id
    

    // BUILDING DOM ELEMENTS
    $(this.element)
    .prepend( $(document.createElement('table'))
      .addClass("listTable")
      .prop("id","list") 
    )
    .append( $(document.createElement('table')).addClass("controlTable")
      .append( $(document.createElement('tbody')) 
        
        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Expiration:') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select')).addClass("survey_select")
                .prop("id","survey_expire")
                .prop("name","survey_expire")
            )
          ) //end 2nd td
        ) // end expiration tr

        .append( $(document.createElement('tr'))
          .append( $(document.createElement('td')).html('Refresh:') 
          )
          .append( $(document.createElement('td') ) 
            .append(
              $(document.createElement('select')).addClass("survey_select") 
                .prop("id","survey_refresh")
                .prop("name","survey_refresh")
            )
          )
        ) // end refresh tr
      ) // end first tbody
    ) //end 2nd table
    
    var options = ["Auto",0,3,4,5,10,15,30,60,120,180,240,300,600,900,1200,1800];

    for(var i in options){
      $(".survey_select").append( $(document.createElement('option'))
        .prop("value", options[i])
        .prop("text", options[i])
      )
    }


    $('#list').dataTable({
      'bPaginate': false,
      'bInfo': false,
      'sAjaxDataProp': 'survey',
      'sAjaxSource': 'php/wireless.survey.php',
      'aoColumns': [
       { 'sTitle': 'Last Seen',		'mData':'Last Seen' },
       { 'sTitle': 'SSID',	'mData':'SSID' },
       { 'sTitle': 'BSSID',		'mData':'BSSID' },
       { 'sTitle': 'RSSI',   'mData':'RSSI' },
       { 'sTitle': 'Noise',   'mData':'Noise' },
       { 'sTitle': 'Quality',  'mData':'Quality' },
       { 'sTitle': 'Ch',   'mData':'Ch' },
       { 'sTitle': 'Capabilities',   'mData':'Capabilities' },
       { 'sTitle': 'Rates',   'mData':'Rates' }
      ]
      })

    this._super();
  }
 });

$(function(){
  //instatiate widgets on document ready
  $('#wirelesssurvey').wirelesssurvey();
})

</script>
