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
<!--   </div>
</div> -->

<script type='text/ecmascript' src='php/bin.etc.php?q=l2tp'></script>
<script type='text/ecmascript'>
//functions for dynamically added buttons

function makeAccordion(accordionElement,accordionList) {
     
  for(i=0; i<accordionList.length; i++){
    
   var id = Math.floor(Math.random() * 10000);
    
    if(accordionList[i].name.length == 0){
    
      $('#accordion').append("<h3 class='"+ id + "'>" + accordionList[i].server + "</h3>")
    
    }else{

      $('#accordion').append("<h3 class='"+ id + "'>" + accordionList[i].name + "</h3>")
    }

    $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value='" + accordionList[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value="+accordionList[i].server +"></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value="+accordionList[i].user +" ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value="+accordionList[i].password +" ></td></tr><tr><td>Secret Key</td><td><input class='l2tp_ssk' name='l2tp_ssk' type='password' value="+accordionList[i].secret +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
  }

  $(accordionElement).accord({static: false});

}

//do this on document load
$(function() {
  makeAccordion("#accordion",l2tp);

  var KEY_ENTER = 13;

  var inputs = document.querySelectorAll('input[type=password]');

  for(var i = 0; i < inputs.length; i++) (function(i){
    function hidePassword(){
    inputs[i].type = 'password';
    }

    function showPassword(){
      inputs[i].type = 'text';
    }

    inputs[i].addEventListener('focus', showPassword, false);
    inputs[i].addEventListener('blur', hidePassword, false);
    inputs[i].addEventListener('keydown', function onBeforeSubmit(e){
      if (e.keyCode === KEY_ENTER) hidePassword();
    }, false);
  })(i);
});



$('#accordion').on('click', '.save_edit', function(){
  //get active record
  n = $("#accordion h3").index($("#accordion h3.ui-state-active"));

  var inputArr = $("#accordion :input" ).serializeArray();
  $('#accordion').html('');

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

     noty({text: 'Saved'});

    $('#accordion').accord("refresh").accord({static: false, active: n}); 

  })


$('#accordion').on('click', '.delete', function(){
  myid=$(this).parent().attr("class").match(/\d+/)
  $('.' + myid).remove();
  $('#accordion').accord("refresh").accord({static: false});
})


//Add functions
function addNew() {
  var id = Math.floor(Math.random() * 10000);
      $('#accordion').append("<h3 class='"+ id + "'>(New Entry)<a href='#' class='fright delete'>x</a></h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value=''></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value='' ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value='' ></td></tr><tr><td>Secret Key</td><td><input class='l2tp_ssk' name='l2tp_ssk' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")

        $('#accordion').accord("refresh").accord("newItem").accord({ active: -1, static: false}); 
}

</script>

