<div class='pageTitle'>Network: Static IPs</div>

<!--
 DHCP Leases
 ARP List
 Static Addresses?
-->

<div class='controlBox'><span class='controlBoxTitle'>Static Devices</span><div class='controlBoxContent'>

<table id='list' class='listTable'></table>

</div></div>

<input type='button' id='test' value='Test' onclick='composeStaticList();'>
<input type='button' value='Save' onclick='saveStaticList();'>
  <input type='button' value='Cancel' onclick='cancelStaticList();'>

<div class='controlBox'><span class='controlBoxTitle'>Demo</span><div class='controlBoxContent'>
<pre id='demo'></pre></div>
 </div>
</div>

<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt;

function composeStaticList(){
 var list = $.map( lt.fnGetData(), function(v,k){ return [v.hostname,v.mac,v.ip].join(','); }).join(';');

 $('#demo').html( list.replace(/;/g,';\n') );
}

lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'staticips',
  'sAjaxSource': 'php/bin.network.staticips.php',
  'aoColumns': [
   { 'sTitle': 'MAC',		'mData':'mac' },
   { 'sTitle': 'Address',	'mData':'ip' },
   { 'sTitle': 'Name',		'mData':'hostname' }
   ],
  'fnInitComplete': function(){
   $('td', this.fnGetNodes()).editable(function(value, settings){
     var cPos = lt.fnGetPosition(this)
     lt.fnUpdate(value,cPos[0],cPos[1]);
//     $('#demo').html( lt.fnGetPosition(this).join(',') );
     //$(this).editable()
     return value;
    }, {
     'onblur':'submit',
     'event': 'dblclick',
     'placeholder' : '',
    });
  }
});

$(function(){
});
</script>
