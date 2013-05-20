<?php
// include('../php/bin.sys.php');
?>
<form id='fe'>
<div class='pageTitle'>Network: Static IPs</div>
<div class='controlBox'>
<!--
 DHCP Leases
 ARP List
 Static Addresses?
-->
<table id='list'></table>
<!-- input type='button' value='test' onclick='sub();' -->
</div>

<div class='controlBox'><pre id='demo'></pre></div>

</form>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>
 var oTable = $('#list').dataTable({
  "sAjaxDataProp": "staticips",
  "sAjaxSource": "php/bin.network.staticips.php",
  "aoColumns": [
   { "sTitle": "MAC",		"mData":"mac" },
   { "sTitle": "Address",	"mData":"ip" },
   { "sTitle": "Name",		"mData":"hostname" }
  ],
  "fnDrawCallback": function(){
   $('#list tbody td').editable(function(v,y){
    $('#demo').append('E: '+ v +'; '+ what(y) +'\n');
    return v;
   },{
    "callback": function(v,y){
     $('#demo').append('C: '+ v +'; '+ what(y) +'\n');
     /* Redraw the table from the new data on the server */
     oTable.fnDraw();
    },
    "submitdata": { "sub": "fix" },
    "height": "14px"
   });
  }
 });
/*
.$('td').editable(function(v,s){
   $('#demo').append('S: '+ v +'; '+ s);
   return 'E:'+v;
  },{
   "callback": function(sV,y){
    $('#demo').append('C: '+ v +'; '+ s);
   },
//   "submitdata": function(v,s){
//    $('#demo').append('D: '+ v +'; '+ s);
//   },
   "height": "14px",
   "width": "100%"
  }
 );
*/
//;

 
/*
 $('#list > td').editable(function(v,s){
   $('#demo').append('S: '+ v +'; '+ s);
   return 'E:'+v;
  },{
   "callback": function(sV,y){
    $('#demo').append('C: '+ v +'; '+ s);
   },
   "submitdata": function(v,s){
    $('#demo').append('D: '+ v +'; '+ s);
   }
  }
 );
*/

$(function(){


/* oTable.$('td').editable(function(v,s){
   $('#demo').append('S: '+ v +'; '+ s);
   return 'E:'+v;
  },{
   "callback": function(sV,y){
    $('#demo').append('C: '+ v +'; '+ s);
   },
//   "submitdata": function(v,s){
//    $('#demo').append('D: '+ v +'; '+ s);
//   },
   "height": "14px",
   "width": "100%"
  }
 );
*/

});
</script>
