<!-- 
persistent data
-->

<link rel="stylesheet" href="/libs/jquery-ui.min.css" />
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>

<div class='pageTitle'>VPN: IPSEC</div>

<br>
<div id="accordion">
<!-- filled with accordion plugin + ajax request-->
</div>
<br>
<input type=button name='add_new' class='add_new' value='Add New' onClick='addNew();'/>

<script type='text/ecmascript' src='php/bin.etc.php?q=ipsec'></script>
<script type='text/ecmascript'>
//functions for dynamically added buttons

$('#accordion').on('click', '.save_edit', function(){
  var inputArr = $( ":input" ).serializeArray()
  $('#accordion').html('');
  console.log(inputArr)

  //every 4th value starts a new set
  for(i=0; i<inputArr.length; i=i+6){

    var id = Math.floor(Math.random() * 10000);
    if(inputArr[i].value.length == 0){
      $('#accordion').append("<h3 class='"+ id + "'>" + inputArr[i+1].value + "<a href='#' class='fright delete'>x</a></h3>")
    }else{
      $('#accordion').append("<h3>" + inputArr[i].value + "<a href='#' class='fright delete'>x</a></h3>")
    }
    $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table id='"+ id + "' class='controlTable'><tbody> <tr><td>Name</td><td><input class='ipsec_name' name='pptp_name' value='" + inputArr[i].value + "'></td></tr>  <tr><td>Server</td><td><input class='ipsec_server' name='ipsec_server' value="+inputArr[i+1].value +"></td></tr> <tr><td>Username</td><td><input class='ipsec_username' name='ipsec_username' value="+inputArr[i+2].value +" ></td></tr> <tr><td>Password</td><td><input class='ipsec_password' name='ipsec_password' type='password' value="+inputArr[i+3].value +" ></td></tr><tr><td>Secret Key</td><td><input class='ipsec_ssk' name='ipsec_ssk' type='password' value="+inputArr[i+4].value +" ></td></tr><tr><td>Certification</td><td><input class='ipsec_certs' name='ipsec_certs' type='password' value="+inputArr[i+5].value +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
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
      $('#accordion').append("<h3 class='"+ id + "'>(New Entry)<a href='#' class='fright delete'>x</a></h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='ipsec_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='ipsec_server' name='ipsec_server' value=''></td></tr> <tr><td>Username</td><td><input class='ipsec_username' name='ipsec_username' value='' ></td></tr> <tr><td>Password</td><td><input class='ipsec_password' name='ipsec_password' type='password' value='' ></td></tr><tr><td>Secret Key</td><td><input class='ipsec_ssk' name='ipsec_ssk' type='password' value='' ></td></tr><tr><td>Certification</td><td><input class='ipsec_certs' name='ipsec_certs' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
      $('#accordion').accordion("refresh").accordion({ collapsible: true, animate: false, active: -1
      }); 
 
}

$( document ).ready(function() {
     
      for(i=0; i<ipsec.length; i++){

        var id = Math.floor(Math.random() * 10000);
        if(ipsec[i].name.length == 0){
          $('#accordion').append("<h3 class='"+ id + "'>" + ipsec[i].server + "<a href='#' class='fright delete'>x</a></h3>")
        }else{
          $('#accordion').append("<h3 class='"+ id + "'>" + ipsec[i].name + "<a href='#' class='fright delete'>x</a></h3>")
        }
        $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='ipsec_name' name='pptp_name' value='" + ipsec[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='ipsec_server' name='ipsec_server' value="+ipsec[i].server +"></td></tr> <tr><td>Username</td><td><input class='ipsec_username' name='ipsec_username' value="+ipsec[i].user +" ></td></tr> <tr><td>Password</td><td><input class='ipsec_password' name='ipsec_password' type='password' value="+ipsec[i].password +" ></td></tr><tr><td>Secret Key</td><td><input class='ipsec_ssk' name='ipsec_ssk' type='password' value="+ipsec[i].secret +" ></td></tr><tr><td>Certification</td><td><input class='ipsec_certs' name='ipsec_certs' type='password' value="+ipsec[i].certs +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
      }
    
      $(function makeAccordion() {
          $( "#accordion" ).accordion({ heightStyle: "content", active: "false",
          collapsible: "true" });
      });
});


</script>

