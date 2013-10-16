<!-- wizard
persistent data
-->

<link rel="stylesheet" href="/libs/jquery-ui.min.css" />
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>

<div class='pageTitle'>VPN: Open VPN</div>

<br>
<div id="accordion">
<!-- filled with accordion plugin + ajax request-->
</div>
<br>
<input type=button name='add_new' class='add_new' value='Add New' onClick='addNew();'/>

<!-- wizardry -->
<br><br><a href="#">Upload Config File</a> -or- 
<a href="#" onClick='showWizard()'>Use Wizard</a><br><br>
<img id='wizard' class='noshow' src="http://incogman.net/wp-content/uploads/2010/12/MAN-BEHIND-CURTAIN-SMALL.jpg">
<p class='noshow'>Pay no attention to that man behind the curtain</p>
<input type='button' class='noshow' value='Okay!' id='okay' onclick='ok()'>
<input type='button' class='noshow' value='No Way!' id='noWay' onclick='no()'>
<p id='message'></p>


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
    $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table id='"+ id + "' class='controlTable'><tbody> <tr><td>Name</td><td><input class='openvpn_name' name='pptp_name' value='" + inputArr[i].value + "'></td></tr>  <tr><td>Server</td><td><input class='openvpn_server' name='openvpn_server' value="+inputArr[i+1].value +"></td></tr> <tr><td>Username</td><td><input class='openvpn_username' name='openvpn_username' value="+inputArr[i+2].value +" ></td></tr> <tr><td>Password</td><td><input class='openvpn_password' name='openvpn_password' type='password' value="+inputArr[i+3].value +" ></td></tr><tr><td>Secret Key</td><td><input class='openvpn_ssk' name='openvpn_ssk' type='password' value="+inputArr[i+4].value +" ></td></tr><tr><td>Certification</td><td><input class='openvpn_certs' name='openvpn_certs' type='password' value="+inputArr[i+5].value +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
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
      $('#accordion').append("<h3 class='"+ id + "'>(New Entry)<a href='#' class='fright delete'>x</a></h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='openvpn_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='openvpn_server' name='openvpn_server' value=''></td></tr> <tr><td>Username</td><td><input class='openvpn_username' name='openvpn_username' value='' ></td></tr> <tr><td>Password</td><td><input class='openvpn_password' name='openvpn_password' type='password' value='' ></td></tr><tr><td>Secret Key</td><td><input class='openvpn_ssk' name='openvpn_ssk' type='password' value='' ></td></tr><tr><td>Certification</td><td><input class='openvpn_certs' name='openvpn_certs' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
        $('#accordion').accordion("refresh").accordion({active: -1}); 
}

$( document ).ready(function() {
 
  $.ajax("php/bin.vpn.openvpn.php", {
    type: 'post',
    dataType: "json",
    data: $("#fe").serialize(),
    success: function(o){
     
      for(i=0; i<o.openvpn.length; i++){

        var id = Math.floor(Math.random() * 10000);
        if(o.openvpn[i].name.length == 0){
          $('#accordion').append("<h3 class='"+ id + "'>" + o.openvpn[i].server + "<a href='#' class='fright delete'>x</a></h3>")
        }else{
          $('#accordion').append("<h3 class='"+ id + "'>" + o.openvpn[i].name + "<a href='#' class='fright delete'>x</a></h3>")
        }
        $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='openvpn_name' name='pptp_name' value='" + o.openvpn[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='openvpn_server' name='openvpn_server' value="+o.openvpn[i].server +"></td></tr> <tr><td>Username</td><td><input class='openvpn_username' name='openvpn_username' value="+o.openvpn[i].user +" ></td></tr> <tr><td>Password</td><td><input class='openvpn_password' name='openvpn_password' type='password' value="+o.openvpn[i].password +" ></td></tr><tr><td>Secret Key</td><td><input class='openvpn_ssk' name='openvpn_ssk' type='password' value="+o.openvpn[i].secret +" ></td></tr><tr><td>Certification</td><td><input class='openvpn_certs' name='openvpn_certs' type='password' value="+o.openvpn[i].certs +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
      }
    
      $(function makeAccordion() {
          $( "#accordion" ).accordion({ heightStyle: "content", active: "false",
          collapsible: "true" });
      });

    }
  })

});

//wizardry
function showWizard() {
	$('.noshow').show();
	$('#message').html('')
}

function no() {
	$('.noshow').hide();
	$('#message').append('I am a very good man. I am just a very bad Wizard.')
}

function ok() {
	$('.noshow').hide();
	$('#message').append('I will have to give the matter a little thought! Go home and come back tomorrow.</p>')


}
</script>

