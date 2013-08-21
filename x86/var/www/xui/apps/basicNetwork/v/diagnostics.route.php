<div class='pageTitle'>Diagnostics: Route</div>
<!-- TODO: 
-->
<div class='controlBox'>

    <span class='controlBoxTitle'>Current Routing Table</span>
    <div class='controlBoxContent'>
        <pre id='result'></pre>
        <table id='list' class='listTable'></table>
        <input type='button' id='reload' value='Reload' onclick='route();'>
      
    </div> <!--end control box content -->
</div> <!--end control box  -->



<!-- COPIED FROM NETWORK: STATIC IP's, partially modified
NEEDS LOTS OF WORK -->

<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt=  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'route',
  'sAjaxSource': 'php/bin.diagnostics.route.php',
  'aoColumns': [
   { 'sTitle': 'Destination',		'mData':'Destination' },
   { 'sTitle': 'Gateway ',	'mData':'Gateway' },
   { 'sTitle': 'Genmask',		'mData':'Genmask' },
   { 'sTitle': 'Flags',   'mData':'Flags' },
   { 'sTitle': 'Metric',   'mData':'Metric' },
   { 'sTitle': 'Ref',   'mData':'Ref' },
   { 'sTitle': 'Use',   'mData':'Use' },
   { 'sTitle': 'Iface',   'mData':'Iface' }
  ],
//   'fnInitComplete': function(){
//     $('td', this.fnGetNodes()).editable(function(value, settings){
//      var cPos = lt.fnGetPosition(this)
//      lt.fnUpdate(value,cPos[0],cPos[1]);
// //     $('#result').html( lt.fnGetPosition(this).join(',') );
//      //$(this).editable()
//      return value;
//     }, {
//      'onblur':'submit'
//    });
//   }
 });

</script>
