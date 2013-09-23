<div class='pageTitle'>Diagnostics: Trace</div>

<!-- TODO: 

-->
<div class='controlBox'>
    <span class='controlBoxTitle'>Traceroute</span>
    <div class='controlBoxContent'>
      <table class='controlTable'>
        <tbody>
          <tr>
              <td>Address</td>
              <td><input id='trace_address' name='trace_address'></td>           
              <td><input type='button' id='trace' value='Trace' onClick='tracer()'></td>
          </tr>
          <tr>
              <td>Max Hops</td>
              <td><input id='max_hops' name='max_hops' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Max Wait Time</td>
              <td><input id='max_wait' name='max_wait' class='shortinput' /><span class='smallText'> (bytes)</span></td>
          </tr>
        </tbody>
    </table>

    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div class='controlBoxContent'>
    <pre id='result'></pre>
    <table id='list' class='listTable nothere'></table>
  </div>
</div>



<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript' src='php/bin.etc.php?q=trace'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>

<script type='text/ecmascript'>

 var lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'trace',
  'sAjaxSource': 'php/bin.diagnostics.trace.php',
  'aoColumns': [
   { 'sTitle': 'Hop',   'mData':'Hop' },
   { 'sTitle': 'Address', 'mData':'Address' },
   { 'sTitle': 'Min (ms)',    'mData':'Min' },
   { 'sTitle': 'Max (ms)',   'mData':'Max' },
   { 'sTitle': 'Avg (ms)',   'mData':'Avg' },
   { 'sTitle': '+/- (ms)',   'mData':'+/-' }

  ]
 });

function tracer(){
  $('#list').removeClass('nothere');
}

 $('#trace_address').ipspinner().ipspinner('value',trace.address);
$('#max_hops').spinner({ min: 0, max: 3600 }).spinner('value',trace.hops);
$('#max_wait').spinner({ min: 0, max: 3600 }).spinner('value',trace.wait);


</script>
