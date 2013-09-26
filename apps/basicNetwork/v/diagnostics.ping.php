<div class='pageTitle'>Diagnostics: Ping</div>

<!-- TODO:
 -->

<div class='controlBox'>
    <span class='controlBoxTitle'>Test</span>
    <div class='controlBoxContent'>
      <table class='controlTable'>
        <tbody>
          <tr>
              <td>Address</td>
              <td><input id='ping_address' name='ping_address'></td>           
              <td><input type='button' id='ping' value='Ping' onClick='pingy()'></td>
          </tr>
          <tr>
              <td>Ping Count</td>
              <td><input id='ping_count' name='ping_count' class='shortinput' /></td>
          </tr>
          <tr>
              <td>Packet Size</td>
              <td><input id='ping_size' name='ping_size' class='shortinput' /><span class='smallText'> (bytes)</span></td>
          </tr>
        </tbody>
      </table>

    </div> <!--end control box content -->
</div> <!--end control box  -->


<div class='controlBox'><span class='controlBoxTitle'>Results</span>
  <div class='controlBoxContent'>
    <!-- <pre id='result'></pre> -->
    <!-- <table id='list' class='listTable nothere'> -->
    <table class='listTable dataTable'>
      <tbody>
        <?php 
          $host="www.google.com";

          exec("ping -c 4 " . $host, $output, $result);
          //Print header
          echo "<th>ICMP Request</th><th>TTL</th><th>Time</th>";

          //find out how many elements are in the output
          $outputLength = count($output);
          //loop through output 
          for ($i = 1; $i < $outputLength; $i++){
            //start a new row
            echo "<tr>";
            
            //store current line as string
            $string = $output[$i];
            //make an array by split each string by spaces
            $arr = preg_split('/[\s]+/', $string);

            //find out how many elements are in this array
            $county = count($arr);
            //for each element
            for ($x = 0; $x < $county; $x++){
              
              if (strpos($arr[$x],'=')){
                //split by = to make another array
                $val = explode("=", $arr[$x]);
                //print the 2nd element of this array
                echo "<td>$val[1]</td>";
              }else{

              }
          }

          //close table row
          echo "</tr>";

          // print_r($output);

          // if ($result == 0) {
          // echo "Ping successful!";
          // }else{
          // echo "Ping unsuccessful!";
          // }

          }
          echo "</tbody></table>";


           //loop through output array again 
          for ($i = 0; $i < $outputLength; $i++){
            $string = $output[$i];
            //check each array element for string ---
            if (strpos($string,'---') !==false){
              //find position of the element with ---
              $place = $i;
            }else{}
          }

          //print out each string from that element until the end
          for ($y= $place; $y < $outputLength; $y++){
            echo "<p>$output[$y]</p>";
          }




        ?>
      
  </div>
</div>


<script type='text/ecmascript' src='php/bin.etc.php?q=ping'></script>
<script type='text/ecmascript' src='/libs/jquery.dataTables.min.js'></script>
<script type='text/ecmascript' src='/libs/jquery.jeditable.min.js'></script>
<script type='text/ecmascript'>

 var lt =  $('#list').dataTable({
  'bPaginate': false,
  'bInfo': false,
  'bFilter': false,
  'sAjaxDataProp': 'ping',
  'sAjaxSource': 'php/bin.diagnostics.ping.php',
  'aoColumns': [
   { 'sTitle': 'Seq',		'mData':'Seq' },
   { 'sTitle': 'Address',	'mData':'Address' },
   { 'sTitle': 'RX Bytes',		'mData':'RX' },
   { 'sTitle': 'TTL',   'mData':'TTL' },
   { 'sTitle': 'RTT (ms)',   'mData':'RTT' },
   { 'sTitle': '+/- (ms)',   'mData':'+/-' }

  ]
 });

function pinger(){
  $('#list').removeClass('nothere');
}

$('#ping_address').ipspinner().ipspinner('value',ping.address);
$('#ping_size').spinner({ min: 0, max: 3600 }).spinner('value',ping.size);
$('#ping_count').spinner({ min: 0, max: 3600 }).spinner('value',ping.count);



</script>
