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
    <table id='resultTable' class='listTable'></table>
  </div>
  <div class='controlBoxContent'>
    <pre id='test'>
    </pre>
  </div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=ping'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

function getResults(){
  $('#resultTable').dataTable({
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
}

$('#pingAddress').ipspinner().ipspinner('value',ping.address);
$('#pingSize').spinner({ min: 0, max: 3600 }).spinner('value',ping.size);
$('#pingCount').spinner({ min: 0, max: 3600 }).spinner('value',ping.count);



</script>

