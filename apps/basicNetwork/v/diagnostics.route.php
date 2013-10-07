<div class='pageTitle'>Diagnostics: Route</div>
<!-- TODO: 
-->
<div class='controlBox'>

    <span class='controlBoxTitle'>Current Routing Table</span>
    <div class='controlBoxContent'>
        <table id='resultTable' class='listTable'></table>
        <input type='button' id='reload' value='Reload' onclick='route();'>
      
    </div> <!--end control box content -->
</div> <!--end control box  -->



<!-- COPIED FROM NETWORK: STATIC IP's, partially modified
NEEDS LOTS OF WORK -->

<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

function route(){
  $('#resultTable').dataTable({
    'bDestroy': true,
    'bPaginate': false,
    'bInfo': false,
    'bFilter': false,
    'bSort': false,
    'sAjaxDataProp': 'routeResults',
    'sAjaxSource': 'php/bin.diagnostics.route.php',
    'aoColumns': [
     { 'sTitle': 'Destination',   'mData':'destination' },
     { 'sTitle': 'Gateway ',  'mData':'gateway' },
     { 'sTitle': 'Genmask',   'mData':'genmask' },
     { 'sTitle': 'Flags',   'mData':'flags' },
     { 'sTitle': 'MSS',   'mData':'mss' },
     { 'sTitle': 'Window',   'mData':'window' },
     { 'sTitle': 'IRTT',   'mData':'irtt' },
     { 'sTitle': 'Interface',   'mData':'interface' }
    ]
   });
}

$(function(){
   route();
});


</script>
