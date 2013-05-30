<div class='pageTitle'>Network: Wan</div>

<div class='controlBox'><span class='controlBoxTitle'>DNS</span><div class='controlBoxContent'><table>
<tbody>
<tr><td>DNS Servers</td><td>
 <pre id='dns_servers' class='editableList'>
  <?php
   var_dump($GLOBALS);
  ?>
 </pre>
</td></tr>
</tbody>
</table></div></div>

<input type='button' value='test' onclick='testSub();'>

<div class='controlBox'><span class='controlBoxTitle'>Demo</span><div class='controlBoxContent'>
 <pre id='demo'></pre>
</div></div>

<script type='text/ecmascript' src='php/bin.etc.php?q=dns'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

function testSub(){
 $('#demo').html('Sent: '+$('#fe').serialize() +'\n');
 $.ajax("php/bin.test.php",{
  type: "POST",
  dataType: "text",
  data: $('#fe').serialize(),
  complete: function(r,s){
   $('#demo').append( s+':\n'+r.responseText );
  }
 })
}

function alTest(UL){
 var LI = document.createElement('li');
 $('#'+UL).append(LI).sortable('refresh').sortable().trigger('create');
 meTest(LI);
 $(LI).trigger('dblclick');
}

function meTest(item){
 $(item).editable(function(value, settings){
  if(value==''){ $(this).remove(); };
  $('#'+ $(this).attr('data-formElement') ).val(value);
  return value;
 },{ 'onblur': 'submit', 'event': 'dblclick' }
 ).click(function(event,ui){ if(event.ctrlKey) $(this).remove(); });
}

function meTestList(listArray, listElement, formElement){

 $('#'+listElement).html( $.map(listArray,function(v,i){
   return ''
   +"<li id='"+ listElement +"_"+ i +"'>"
   +"<input type='hidden' id='"+ formElement +"_"+ i +"' name='"+ formElement +"["+ i +"]' value='"+ v +"'>"
   +"<span class='editableListText' data-formElement='"+ formElement +"_"+ i +"'>"+ v +"</span>"
   +" <a class='deleteX' onclick='$(\"#"+ listElement +"_"+ i +"\").remove();'>X</a>"
   +"</li>";
  }).join('') ).sortable({

  forcePlaceholderSize: true,
  forceHelperSize: true,
  placeholder: "editableListPlaceholder",
  items: "li:not(.listBookend)",
  create: function(event,ui){
   meTest($(this).find('.editableListText'));
//   $(formElement).val($(listElement).sortable('toArray'));
  },
//  stop: function(event,ui){
//   $(formElement).val($(listElement).sortable('toArray'));
//  }
 });
}

// meTestList(dns.servers,'dns_server_list','dns_servers');

$.widget( "jai.editablelist", $.ui.sortable, {
 _create: function(){
//  $('#demo').html("Element: "+ what( this.element.attr('id'), true) );
//return;
  var fid = this.element.attr('id')
//  $('#demo').append("Fid: "+ fid +'\n');
  $(this.element).html(
   $.map(this.options.list,function(v,i){
    return ''
    +"<li id='"+ fid +"_list_"+ i +"'>"
    +"<input type='hidden' id='"+ fid +"_"+ i +"' name='"+ fid +"["+ i +"]' value='"+ v +"'>"
    +"<span class='editableListText' data-formElement='"+ fid +"_"+ i +"'>"+ v +"</span>"
    +" <a class='deleteX' onclick='$(\"#"+ fid +"_list_"+ i +"\").remove();'>X</a>"
    +"</li>";
   }).join('')
  );
// $(this.element).sortable('refresh');
// <input type='hidden' id='dns_servers' name='dns_servers'>
// <ul id='dns_server_list' class='editableList'></ul><br>
// <input type='button' value='Add' onclick='alTest("dns_server_list")'>

//  $('#demo').html('This: '+what( this.element , true) +'\n\nOptions: '+what( this.options , true));
//  $(this.element).after("<ul id='"+ this.element.id +"_list' class='editableList'></ul>\n<br>"
//<input type='button' value='Add' onclick='addLI("ntp_server_list")'>

 },
 options: {
  forcePlaceholderSize: true,
  forceHelperSize: true,
  placeholder: "editableListPlaceholder",
  items: "li:not(.listBookend)",
 }
});

//$('#dns_servers').editablelist({
// list: dns.servers
//});


//$(function(){});

</script>
