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
              <td><input id='ping_address' name='ping_address'></td>           
              <td><input type='button' id='ping' value='Ping' onClick='pingy()'></td>
          </tr>
          <tr>
              <td>Ping Count</td>
              <td><input id='ping_count' name='ping_count' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Packet Size</td>
              <td><input id='ping_size' name='ping_size' class='shortinput' /><span class='smallText'> (bytes)</span></td>
          </tr>
        </tbody>
      </table>

    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div id='results' class='controlBoxContent'>
       
  </div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=ping'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

function pingy() {
  $('#ping').attr('disabled','disabled');

  $.ajax({
    type : 'GET',
    dataType : 'html',
    url:"php/bin.diagnostics.ping.php", 
    success: function(data) {
      $("#results").append(data);

      $('#list').dataTable({
      'bAutoWidth': false,
      'bPaginate': false,
      'bInfo': false,
      'bFilter': false,
      'bSort': false,
      'aoColumns': [
       { 'sTitle': 'ICMP Req' },
       { 'sTitle': 'TTL' },
       { 'sTitle': 'Time (ms)' }
        ]
      });
      alert( "Ping Successful" );
    }
  });
} ;



$('#ping_address').ipspinner().ipspinner('value',ping.address);
$('#ping_size').spinner({ min: 0, max: 3600 }).spinner('value',ping.size);
$('#ping_count').spinner({ min: 0, max: 3600 }).spinner('value',ping.count);



</script>

