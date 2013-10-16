<link rel="stylesheet" href="/libs/jquery-ui.min.css" />
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>

<div class='pageTitle'>VPN: L2TP</div>

<!-- TODO: l2tp_mppe, l2tp_stateful
persistent data
-->

<!-- <div class='controlBox'><span class='controlBoxTitle'>L2TP</span>
	<div class='controlBoxContent'> -->
    <br>
    <div id="accordion">
    <!-- filled with accordion plugin + ajax request-->
    </div>
    <br>
    <input type=button name='add_new' class='add_new' value='Add New' onClick='addNew();'/>
<!--   </div>
</div> -->

<script type='text/ecmascript'>
//functions for dynamically added buttons

$('#accordion').on('click', '.save_edit', function(){
  var inputArr = $( ":input" ).serializeArray()
  $('#accordion').html('');
  console.log(inputArr)

  //every 4th value starts a new set
  for(i=0; i<inputArr.length; i=i+5){

    var id = Math.floor(Math.random() * 10000);
    if(inputArr[i].value.length == 0){
      $('#accordion').append("<h3 class='"+ id + "'>" + inputArr[i+1].value + "<a href='#' class='fright delete'>x</a></h3>")
    }else{
      $('#accordion').append("<h3>" + inputArr[i].value + "<a href='#' class='fright delete'>x</a></h3>")
    }
    $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table id='"+ id + "' class='controlTable'><tbody> <tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value='" + inputArr[i].value + "'></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value="+inputArr[i+1].value +"></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value="+inputArr[i+2].value +" ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value="+inputArr[i+3].value +" ></td></tr><tr><td>Secret Key</td><td><input class='l2tp_ssk' name='l2tp_ssk' type='password' value="+inputArr[i+4].value +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
    }

    $('#accordion').accordion("refresh");

  })


$('#accordion').on('click', '.delete', function(){
  myid=$(this).parent().attr("class").match(/\d+/)
  console.log('clicked delete' +myid)
  $('.' + myid).remove();
  $('#accordion').accordion("refresh").accordion(
    { animate: "false", 
      heightStyle: "content", 
      active: "false",
      collapsible: "true"

    });
})


//Add functions
function addNew() {
  var id = Math.floor(Math.random() * 10000);
      $('#accordion').append("<h3 class='"+ id + "'>(New Entry)<a href='#' class='fright delete'>x</a></h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value=''></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value='' ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value='' ></td></tr><tr><td>Secret Key</td><td><input class='l2tp_ssk' name='l2tp_ssk' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
        $('#accordion').accordion("refresh").accordion({active: -1}); 
}

$( document ).ready(function() {
 
  $.ajax("php/bin.vpn.l2tp.php", {
    type: 'post',
    dataType: "json",
    data: $("#fe").serialize(),
    success: function(o){
     
      for(i=0; i<o.l2tp.length; i++){

        var id = Math.floor(Math.random() * 10000);
        if(o.l2tp[i].name.length == 0){
          $('#accordion').append("<h3 class='"+ id + "'>" + o.l2tp[i].server + "<a href='#' class='fright delete'>x</a></h3>")
        }else{
          $('#accordion').append("<h3 class='"+ id + "'>" + o.l2tp[i].name + "<a href='#' class='fright delete'>x</a></h3>")
        }
        $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value='" + o.l2tp[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value="+o.l2tp[i].server +"></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value="+o.l2tp[i].user +" ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value="+o.l2tp[i].password +" ></td></tr><tr><td>Secret Key</td><td><input class='l2tp_ssk' name='l2tp_ssk' type='password' value="+o.l2tp[i].secret +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
      }
    
      $(function makeAccordion() {
          $( "#accordion" ).accordion({ heightStyle: "content", active: "false",
          collapsible: "true" });
      });

    }
  })

});


</script>

