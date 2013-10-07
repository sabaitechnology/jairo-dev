<div class='pageTitle'>Diagnostics: Ping</div>

<!-- TODO:
 -->

<div class='controlBox'>
    <span class='controlBoxTitle'>Test</span>
    <div class='controlBoxContent'>
      <table class='controlTable'>
        <tbody>
          <tr>
              <td>Address</td>
              <td><input id='pingAddress' name='pingAddress'></td>           
              <td><input type='button' id='ping' value='Ping' onClick='getResults()'></td>
          </tr>
          <tr>
              <td>Ping Count</td>
              <td><input id='pingCount' name='pingCount' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Packet Size</td>
              <td><input id='pingSize' name='pingSize' class='shortinput' /><span class='smallText'> (bytes)</span></td>
          </tr>
        </tbody>
      </table>
    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div id='results' class='controlBoxContent'>
    <div id='statistics' class='smallText'></div>
    <table id='resultTable' class='listTable'></table>
  </div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=ping'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

function getResults(){
  $('#statistics').html();

  $('#resultTable').dataTable({
    "bDestroy":true,
    'bPaginate': false,
    'bInfo': false,
    'bFilter': false,
    "sAjaxDataProp": "pingResults",
    "fnServerParams": function(aoData){ $.merge(aoData,$('#fe').serializeArray()); },
    "sAjaxSource": "php/bin.diagnostics.ping.php",
    "aoColumns": [
      { "sTitle": "Count",  "mData":"count" },
      { "sTitle": "Bytes",  "mData":"bytes" },
      { "sTitle": "TTL",    "mData":"ttl"   },
      { "sTitle": "Time",   "mData":"time"  }
    ]

  });

 $.ajax({ // ajax call starts
    url: 'php/bin.diagnostics.ping.php', // JQuery loads serverside.php
    data: $('#fe').serializeArray(), // Send input values
    dataType: 'json', // Choosing a JSON datatype
    success: function(data) {
      console.log(data);
      var stats=data['pingStatistics'].split(',');
      var info=data['pingInfo'].split(',');
      $('#statistics').append('--Summary--<br>Round-Trip: '+stats[0]+' min, '+stats[1]+' avg, '+stats[2]+' max (ms)<br>');
      $('#statistics').append('Packets: '+info[0]+' transmitted, '+info[1]+' received, '+info[2]+'% lost<br><br>');
    }
  })
}

$('#pingAddress').ipspinner().ipspinner('value',ping.address);
$('#pingSize').spinner({ min: 0, max: 3600 }).spinner('value',ping.size);
$('#pingCount').spinner({ min: 0, max: 3600 }).spinner('value',ping.count);



</script>

