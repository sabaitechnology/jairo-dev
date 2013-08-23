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
              <td><span class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input name="ping_address" id="ping_address" aria-valuenow="30905929509" class="ui-spinner-input" autocomplete="off" role="spinbutton"><a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span>             
              <input type='button' id='trace' value='Trace' onclick='tracer();'>
              </td>
          </tr>
          <tr>
              <td>Maximum Hops</td>
              <td><input id='max_hops' name='max_hops' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Maximum Wait Time</td>
              <td><input id='max_wait' name='max_wait' class='shortinput' /><span class='smallText'>(seconds per hop)</span></td>
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


 $('#ping_address').val(trace.address);
 $('#max_hops').val(trace.hops);
 $('#max_wait').val(trace.wait);

</script>
