<link rel="stylesheet" href="/libs/jquery-ui.min.css" />
<script type='text/ecmascript' src='/libs/jquery-ui.min.js'></script>

<div class='pageTitle'>VPN: L2TP</div>

<!-- TODO: l2tp_mppe, l2tp_stateful

save & cancel functions
persistent data
-->

<div class='controlBox'><span class='controlBoxTitle'>L2TP</span>
	<div class='controlBoxContent'>
    <br>
    <div id="accordion">
    <!-- filled with accordion plugin + ajax request-->
    </div>
    <br>
    <input type='button' id='add_l2tp' value='Add New' onClick='addNew();'>
    <div id='addNew' class='controlBoxContent noshow'>
      <br>
      <table class='controlTable'>
        <thead><th>Add New L2TP</th>
        </thead>
        <tbody>
         <tr><td>Name</td><td><input id='add_name' name='pptp_name' /></td></tr 
         <tr><td>Server</td><td><input id='add_server' name='add_server' /></td></tr>
         <tr><td>Username</td><td><input id='add_username' name='add_username' /></td></tr>
         <tr><td>Password</td><td><input id='add_password' name='add_password' type="password" /></td></tr>
        </tbody>
      </table>
      <br>
      <input type='checkbox' class='connect' checked='checked' name='connect'> Connect Now?</input>
      <br>
      <input type='button' class='fright' id='save_Add' value='Save' onclick='saveAdd();' />
      <input type='button' class='fright' id='cancel_Add' value='Cancel' onClick='cancelAdd();' />
    </div>
  </div>
</div>




<script type='text/ecmascript'>
//functions for dynamically added buttons
$('#accordion').on('click', '.edit_info', function(){
  $(this).parent().parent().children('.connect_div').hide();
  $(this).parent().parent().children('.edit_div').show();
})

$('#accordion').on('click', '.l2tp_save', function(){
  $(this).parent().parent().children('.connect_div').show();
  $(this).parent().parent().children('.edit_div').hide();
  
  $("#accordion").accordion(); 

})

$('#accordion').on('click', '.l2tp_cancel', function(){
  $(this).parent().parent().children('.connect_div').show();
  $(this).parent().parent().children('.edit_div').hide();
  $("#accordion").accordion(); 
})

//Add functions
function addNew() {
  $('#add_l2ptp').hide();
  $('#addNew').show();
}

function cancelAdd() {
  $('#add_name').val('');
  $('#add_server').val('');
  $('#add_username').val('');
  $('#add_password').val('');
  $('#addNew').hide();
  $('#add_l2tp').show();
}

function saveAdd() {
    var newDiv = "<h3>"+ $('#add_name').val() + "</h3><div><div class='ui-accordion-content'><div class='connect_div'><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Edit Info' name='edit_info' class='edit_info'></div><div class='edit_div noshow'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value='" + $('#add_name').val() + "'></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value="+$('#add_server').val() +"></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value="+$('#add_username').val() +" ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value="+$('#add_password').val() +" ></td></tr></tbody></table><br><input type='button' class='fright l2tp_save' value='Save'><input type='button' class='fright l2tp_cancel' value='Cancel'></div></div>";
    $('#accordion').append(newDiv)
    $('#accordion').accordion("refresh"); 
    cancelAdd();       
};


$( document ).ready(function() {
 
  $.ajax("php/bin.vpn.l2tp.php", {
    type: 'post',
    dataType: "json",
    data: $("#fe").serialize(),
    success: function(o){
     
      for(i=0; i<o.l2tp.length; i++){

        if(o.l2tp[i].name.length == 0){
          $('#accordion').append("<h3>" + o.l2tp[i].server + "</h3>")
        }else{
          $('#accordion').append("<h3>" + o.l2tp[i].name + "</h3>")
        }

        $('#accordion').append("<div class='ui-accordion-content'><div class='connect_div'><input type='button' value='Connect' name='connect' class='connect' ><input type='button' value='Disconnect' name='disconnect' class='disconnect'><input type='button' value='Edit Info' name='edit_info' class='edit_info'></div><div class='edit_div noshow'><table class='controlTable'><tbody> <tr><td>Name</td><td><input class='l2tp_name' name='pptp_name' value='" + o.l2tp[i].name + "'></td></tr>  <tr><td>Server</td><td><input class='l2tp_server' name='l2tp_server' value="+o.l2tp[i].server +"></td></tr> <tr><td>Username</td><td><input class='l2tp_username' name='l2tp_username' value="+o.l2tp[i].user +" ></td></tr> <tr><td>Password</td><td><input class='l2tp_password' name='l2tp_password' type='password' value="+o.l2tp[i].password +" ></td></tr></tbody></table><br><input type='button' class='fright l2tp_save' value='Save'><input type='button' class='fright l2tp_cancel' value='Cancel'></div>")
      }
    
      $(function() {
          $( "#accordion" ).accordion({ heightStyle: "content" });
      });

    }
  })

});


</script>

