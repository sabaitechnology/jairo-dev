<div class='pageTitle'>Network: Wan</div>

<div class='controlBox'><span class='controlBoxTitle'>Demo</span><div class='controlBoxContent'>
 <pre id='demo'></pre>
</div></div>

<script type='text/ecmascript'>

$(function(){

 var ds = {
  "data": "Here be data, yar!",
  "name": "junk",
  "list": ["One","Bee","Caledonia"],
  "object": {
   "one": 1,
   "two": 2,
   "three": "tres"
  } 
 };

 var tout = JSON.stringify(ds);

 $('#demo').html('O: '+ tout +'\n');

 $.ajax("php/bin.test.php",{
  type: "POST",
  dataType: "json",
  data: { "new": ds },
  complete: function(r,s){

   var tin = r.responseText;
   $('#demo').append('I: '+tin +'\n');

//   var ji = $.parseJSON(tin);
//   var jo = $.parseJSON(tout);
//   $('#demo').append('Same:'+ (tout == tin) );
  }
 })

});

</script>
