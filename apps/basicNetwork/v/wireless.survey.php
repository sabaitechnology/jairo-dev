<div class='pageTitle'>Wireless: Survey</div>

<div class='controlBox'>

    <span class='controlBoxTitle'>Wireless Site Survey</span>
    <div class='controlBoxContent'>
        <pre id='result'></pre>
        <table id='list' class='listTable'></table>
      <div>
        <table><tbody>
          <tr><td> Expiration: </td>
            <td><select id="expire-time">
            <option value="0">Auto Expire</option>
            <option value="3">3 seconds</option>
            <option value="4">4 seconds</option>
            <option value="5">5 seconds</option>
            <option value="10">10 seconds</option>
            <option value="15">15 seconds</option>
            <option value="30">30 seconds</option>
            <option value="60">1 minute</option>
            <option value="120">2 minutes</option>
            <option value="180">3 minutes</option>
            <option value="240">4 minutes</option>
            <option value="300">5 minutes</option>
            <option value="600">10 minutes</option>
            <option value="900">15 minutes</option>
            <option value="1200">20 minutes</option>
            <option value="1800">30 minutes</option>
            </select></td>
          </tr>

          <tr><td>Refresh: </td>
            <td><select id="refresh-time">
            <option value="0">Auto Refresh</option>
            <option value="3">3 seconds</option>
            <option value="4">4 seconds</option>
            <option value="5">5 seconds</option>
            <option value="10">10 seconds</option>
            <option value="15">15 seconds</option>
            <option value="30">30 seconds</option>
            <option value="60">1 minute</option>
            <option value="120">2 minutes</option>
            <option value="180">3 minutes</option>
            <option value="240">4 minutes</option>
            <option value="300">5 minutes</option>
            <option value="600">10 minutes</option>
            <option value="900">15 minutes</option>
            <option value="1200">20 minutes</option>
            <option value="1800">30 minutes</option>
            </select></td>
          </tr>
        
      </div>
      <br>
    </div> <!--end control box content -->
</div> <!--end control box  -->



<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>



var lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'sAjaxDataProp': 'survey',
  'sAjaxSource': 'php/bin.wireless.survey.php',
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

 });

</script>
