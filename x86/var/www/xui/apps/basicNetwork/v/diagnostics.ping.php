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
              <td>
                <span class="ui-spinner ui-widget ui-widget-content ui-corner-all"><input name="ping_address" id="ping_address" aria-valuenow="30905929509" class="ui-spinner-input" autocomplete="off" role="spinbutton"><a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">▲</span></span></a><a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only" tabindex="-1" role="button" aria-disabled="false"><span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">▼</span></span></a></span>             
                <input type='button' id='ping' value='Ping' onclick='ping();'></td>
          </tr>
          <tr>
              <td>Ping Count</td>
              <td><input id='ping_count' name='ping_count' class='shortinput'/></td>
          </tr>
          <tr>
              <td>Packet Size</td>
              <td><input id='ping_size' name='ping_size' class='shortinput' /><span class='smallText'>(bytes)</span></td>
          </tr>
      </tbody>
    </table>

    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div class='controlBoxContent'>
    <pre id='result'></pre>
    <table id='list' class='listTable'></table>
  </div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=ping'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'ping',
  'sAjaxSource': 'php/bin.diagnostics.ping.php',
  'aoColumns': [
   { 'sTitle': 'Seq',		'mData':'Seq' },
   { 'sTitle': 'Address',	'mData':'Address' },
   { 'sTitle': 'RX Bytes',		'mData':'RX' },
   { 'sTitle': 'TTL',   'mData':'TTL' },
   { 'sTitle': 'RTT (ms)',   'mData':'RTT' },
   { 'sTitle': '+/- (ms)',   'mData':'+/-' }

  ]
 });

 $('#ping_count').val(ping.count);
 $('#ping_size').val(ping.size);


</script>
