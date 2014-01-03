<!-- TODO: persistent data-->

<div class='pageTitle'>VPN: PPTP</div>

<br>
<div id="accordion">
<!-- filled with accordion plugin + ajax request-->
</div>

<script type='text/ecmascript' src='php/etc.php?q=pptp'></script>
<script type='text/ecmascript'>

  function makeAccordion(accordionElement,accordionList) {
    
    for(i=0; i<accordionList.length; i++){
      var id = Math.floor(Math.random() * 10000);
      
      if(accordionList[i].name.length == 0){
        $('#accordion').append("<h3 class='"+ id + "'>" + accordionList[i].server + "</h3>")
      }else{
        $('#accordion').append("<h3 class='"+ id + "'>" + accordionList[i].name + "</h3>")
      }
      $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + accordionList[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+accordionList[i].server +"></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+accordionList[i].user +" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+accordionList[i].password +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
    }

    $(accordionElement).accord({static: false});
  }

  //do this on document load
  $(function() {
    makeAccordion("#accordion",pptp);
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
    var inputArr = $("#accordion :input" ).serializeArray()
    $('#accordion').html('');
    //every 4th value starts a new set
    for(i=0; i<inputArr.length; i=i+4){

      var id = Math.floor(Math.random() * 10000);
      if(inputArr[i].value.length == 0){
        $('#accordion').append("<h3 class='"+ id + "'>" + inputArr[i+1].value + "</h3>")
      }else{
        $('#accordion').append("<h3>" + inputArr[i].value + "</h3>")
      }
    $('#accordion').append("<div class='ui-accordion-content "+ id + "'><table id='"+ id + "' class='controlTable'><tbody> <tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value='" + inputArr[i].value + "'></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value="+inputArr[i+1].value +"></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value="+inputArr[i+2].value +" ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value="+inputArr[i+3].value +" ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
    }

    toServer('Save this.');
    $('#accordion').accord("refresh").accord({active: n, static: false}); 

  })


  $('#accordion').on('click', '.delete', function(){
    myid=$(this).parent().attr("class").match(/\d+/)
    $('.' + myid).remove();
    $('#accordion').accord("refresh").accord({active:false, static: false});
  })


  function addNew() {
    var id = Math.floor(Math.random() * 10000);
    $('#accordion').append("<h3 class='"+ id + "'>(New Item)</h3><div class='ui-accordion-content "+ id + "'><table  class='controlTable'><tbody><tr><td>Name</td><td><input class='pptp_name' name='pptp_name' value=''></td></tr>  <tr><td>Server</td><td><input class='pptp_server' name='pptp_server' value=''></td></tr> <tr><td>Username</td><td><input class='pptp_username' name='pptp_username' value='' ></td></tr> <tr><td>Password</td><td><input class='pptp_password' name='pptp_password' type='password' value='' ></td></tr></tbody></table><br><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Save' name='save_edit' class='save_edit'></div>")
    $('#accordion').accord("refresh").accord("newItem").accord({ active: -1, static: false}); 
  }


</script>

